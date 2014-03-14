<?php

namespace BettingSas\Bundle\GambleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of ProcessGambleCommand
 *
 * @author jobou
 */
class ProcessGambleCommand extends ContainerAwareCommand
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $om;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(ObjectManager $om, LoggerInterface $logger)
    {
        $this->om = $om;
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('gamble:process')
            ->setDescription('Process all events marked as finished and not processed to update gamble states')
        ;
    }

    /**
     * Command logic
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getLogger()->info("Start gamble:process command");

        // select all events which has ended and has not already been processed
        $events = $this->om
            ->getRepository('BettingSasCompetitionBundle:Event')
            ->findAllEndedAndNotProcessedEvent();

        foreach ($events as $event) {
            if (!$event->hasResult()) {
                $this->getLogger()->info('Event '.$event->getId().' has ended but has no result yet.');
                continue;
            }

            // Process all gamble with this event
            $this->processGambleWithBetsOnEvent($event);

            // Clear all gamble loaded in doctrine
            $this->om->clear('BettingSasGambleBundle:Gamble');

            // Flag the event has processed
            $event->setProcessed(true);

            // TODO mass flush
            $this->om->persist($event);
            $this->om->flush();
        }

        // Process all gambles with at least one wining bet
        $this->processGambleWithWinnerBet();

        $this->getLogger()->info("End gamble:process command");
    }

    /**
     * Process an event and the gambles having it
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     */
    protected function processGambleWithBetsOnEvent(Event $event)
    {
        $this->getLogger()->info("Start process event ".$event->getId());

        // Select all gambles having the event in its bets
        $gambles = $this->om
            ->getRepository('BettingSasGambleBundle:Gamble')
            ->findAllGambleHavingBetsOnEvent($event);

        foreach ($gambles as $gamble) {
            // Check if the bets are winners in the processed gamble
            $this->getContainer()->get('betting_sas.gamble.processor')->processGambleWithEvent($gamble, $event);

            // TODO mass flush
            $this->om->persist($gamble);
            $this->om->flush();

            $this->getLogger()->info("Gamble #".$gamble->getId()." had bet on this event");
        }

        $this->getLogger()->info("End process event ".$event->getId());
    }

    /**
     * Process a gamble with a least a winning bet
     */
    protected function processGambleWithWinnerBet()
    {
        $this->getLogger()->info("Start process gamble with winning bet");

        $gambles = $this->om
            ->getRepository('BettingSasGambleBundle:Gamble')
            ->findAllGambleWithProcessedBets();

        foreach ($gambles as $gamble) {
            if ($gamble->hasEnded()) {

                $this->getContainer()->get('betting_sas.gamble.processor')->calculateResult($gamble);
                $gamble->setProcessedDate(new \DateTime());

                $this->om->persist($gamble);
                $this->om->flush();

                $this->getLogger()->info("Gamble #".$gamble->getId()." has been processed");
            }
        }

        $this->getLogger()->info("End process gamble with winning bet");
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    protected function getLogger()
    {
        return $this->logger;
    }
}