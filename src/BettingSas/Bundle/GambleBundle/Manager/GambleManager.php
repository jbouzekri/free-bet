<?php

namespace BettingSas\Bundle\GambleBundle\Manager;

use Twig_Environment as Environment;

use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of GambleManager
 *
 * @author jobou
 */
class GambleManager
{
    /**
     *
     * @var array
     */
    protected $configuration = array();

    /**
     * Constructor
     *
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Render gamble entities for an event
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return array
     */
    public function getGambleEntities(Event $event)
    {
        $type = $event->getType();
        if (!isset($this->configuration[$type])) {
            throw new Exception\UnsupportedEventType($type. ' not supported. Try '.implode(', ', array_keys($this->configuration)));
        }

        $gambles = array();

        $gambleClasses = $this->configuration[$type];
        foreach ($gambleClasses as $key => $gambleClass) {
            $gamble = new $gambleClass();
            $gambles[] = $gamble;
        }

        return $gambles;
    }
}
