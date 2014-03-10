<?php

namespace BettingSas\Bundle\GambleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;

use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of ProcessGambleCommand
 *
 * @author jobou
 */
class ProcessGambleCommand extends ContainerAwareCommand
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
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
        $events = $this->getContainer()
            ->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('BettingSasCompetitionBundle:Event')
            ->createQueryBuilder()
            ->field('date')->lt(new \DateTime())
            ->field('processed')->equals(false)
            ->getQuery()
            ->execute();

        foreach ($events as $event) {

            // Process all gamble with this event
            $this->processGambleWithBetsOnEvent($event);

            $this->getContainer()->get('doctrine_mongodb')->getManager()->clear('BettingSasGambleBundle:Gamble');

            // Flag the event has processed
            $event->setProcessed(true);

            // TODO mass flush
            $this->getContainer()->get('doctrine_mongodb')->getManager()->persist($event);
            $this->getContainer()->get('doctrine_mongodb')->getManager()->flush();
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

        // TODO : remove $id in field
        // use field('bets.event')->equals(\MongoDBRef::create("event", new \MongoId('4e63611cbc347053a2000001'),'database_name')) to ensure index use
        // Select all gambles having the event in its bets
        $gambles = $this->getContainer()
            ->get('doctrine_mongodb')
            ->getRepository('BettingSasGambleBundle:Gamble')
            ->createQueryBuilder()
            ->field('bets.event.$id')->equals(new \MongoId($event->getId()))
            ->getQuery()
            ->execute();

        foreach ($gambles as $gamble) {
            // Foreach gamble, check if the bets are winners
            $this->getContainer()->get('betting_sas.gamble.processor')->processGambleWithEvent($gamble, $event);

            // TODO mass flush
            $this->getContainer()->get('doctrine_mongodb')->getManager()->persist($gamble);
            $this->getContainer()->get('doctrine_mongodb')->getManager()->flush();

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

        $gambles = $this->getContainer()
            ->get('doctrine_mongodb')
            ->getRepository('BettingSasGambleBundle:Gamble')
            ->createQueryBuilder()
            ->field('winner')->exists(false)
            ->field('bets.winner')->exists(true)
            ->getQuery()
            ->execute();

        foreach ($gambles as $gamble) {
            if ($gamble->hasEnded()) {

                // TODO : wining gamble processing
                $gamble->setWinner(false);

                $this->getContainer()->get('doctrine_mongodb')->getManager()->persist($gamble);
                $this->getContainer()->get('doctrine_mongodb')->getManager()->flush();

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