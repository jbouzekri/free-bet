<?php

namespace FreeBet\Bundle\GambleBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Psr\Log\LoggerInterface;
use FreeBet\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface;
use FreeBet\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface;
use FreeBet\Bundle\CompetitionBundle\Document\Event;
use FreeBet\Bundle\GambleBundle\Gamble\GambleProcessor;

/**
 * Description of ProcessGambleCommand
 *
 * @author jobou
 */
class ProcessGambleCommand extends Command
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $om;

    /**
     * @var \FreeBet\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface
     */
    protected $eventRepository;

    /**
     * @var \FreeBet\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface
     */
    protected $gambleRepository;

    /**
     * @var \FreeBet\Bundle\GambleBundle\Gamble\GambleProcessor
     */
    protected $processor;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface $eventRepository
     * @param \FreeBet\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface $gambleRepository
     * @param \FreeBet\Bundle\GambleBundle\Gamble\GambleProcessor $processor
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Doctrine\Common\Persistence\ObjectManager $om,
        EventRepositoryInterface $eventRepository,
        GambleRepositoryInterface $gambleRepository,
        GambleProcessor $processor,
        LoggerInterface $logger
    ) {
        $this->om = $om;
        $this->eventRepository = $eventRepository;
        $this->gambleRepository = $gambleRepository;
        $this->processor = $processor;
        $this->logger = $logger;
        $this->processor->setLogger($this->logger);

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
        //LOCK system
        $fp = fopen(sys_get_temp_dir().'/gamble-process.lock', 'a+');
        if (!flock($fp, LOCK_EX | LOCK_NB)) { //get exclusive lock
            $this->getLogger()->info("Process already running");
            return;
        }

        $this->getLogger()->info("Start gamble:process command");
        $this->date = \FreeBet\Bundle\UIBundle\Services\DateManager::getUtcDateTime();

        $this->processEvents();

        $this->getLogger()->info("End gamble:process command");

        flock($fp, LOCK_UN);
        fclose($fp);
    }

    /**
     * Process Events
     */
    protected function processEvents()
    {
        // select all events which has ended and has not already been processed
        $events = $this->eventRepository->findAllPastNotProcessedEvent($this->date);

        foreach ($events as $event) {
            if (!$event->hasResult()) {
                $this->getLogger()->info('Event '.$event->getId().' has ended but has no result yet.');
                continue;
            }

            // Process all gamble with this event
            $this->processGambleWithBetsOnEvent($event);

            // Clear all gamble loaded in doctrine
            $this->om->clear('FreeBetGambleBundle:Gamble');

            // Flag the event has processed
            $event->setProcessed(true);

            // TODO mass flush
            $this->om->persist($event);
            $this->om->flush();
        }
    }

    /**
     * Process an event and the gambles having it
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     */
    protected function processGambleWithBetsOnEvent(Event $event)
    {
        $this->getLogger()->info("Start process event ".$event->getId());

        // Select all gambles having the event in its bets
        $gambles = $this->gambleRepository->findAllGambleHavingBetsOnEvent($event);

        foreach ($gambles as $gamble) {
            // Check if the bets are winners in the processed gamble
            $this->processor->process($gamble, $event, $this->date);

            // TODO mass flush
            $this->om->persist($gamble);
            $this->om->flush();

            $this->getLogger()->info("Gamble #".$gamble->getId()." had been processed");
        }

        $this->getLogger()->info("End process event ".$event->getId());
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    protected function getLogger()
    {
        return $this->logger;
    }
}
