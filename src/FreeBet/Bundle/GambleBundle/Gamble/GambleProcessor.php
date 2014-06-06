<?php

namespace FreeBet\Bundle\GambleBundle\Gamble;

use FreeBet\Bundle\GambleBundle\Document\Gamble;
use FreeBet\Bundle\CompetitionBundle\Document\Event;
use Psr\Log\LoggerInterface;

/**
 * Description of GambleProcessor
 *
 * @author jobou
 */
class GambleProcessor
{
    /**
     * @var array
     */
    protected $processors;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param array $processors an array of GambleProcessorInterface
     */
    public function __construct(array $processors)
    {
        $this->processors = $processors;
    }

    /**
     * Apply each processor
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     */
    public function process(Gamble $gamble, Event $event, \DateTime $date)
    {
        foreach ($this->processors as $process) {
            if (!$process->apply($gamble)) {
                $this->log('Gamble  #'.$gamble->getId().' : processor '.get_class($process).' not applied');
                continue;
            }

            $process->process($gamble, $event, $date);
            $this->log(
                'Gamble  #'.$gamble->getId()
                .' : processor '.get_class($process)
                .' for event '.$event->getId().' success'
            );
        }
    }

    /**
     * Log a message
     *
     * @param string $message
     */
    protected function log($message)
    {
        if ($this->getLogger()) {
            $this->getLogger()->info($message);
        }
    }

    /**
     * Set the logger
     *
     * @param \Psr\Log\LoggerInterface $logger
     *
     * @return \FreeBet\Bundle\GambleBundle\Gamble\GambleProcessor
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * Get logger
     *
     * @return \Psr\Log\LoggerInterface
     */
    protected function getLogger()
    {
        return $this->logger;
    }
}
