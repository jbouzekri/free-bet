<?php

namespace FreeBet\Bundle\CompetitionBundle\Model;

use FreeBet\Bundle\CompetitionBundle\Exception\UnsupportedEventType;

/**
 * EventFactory
 *
 * @author jobou
 */
class EventFactory
{
    /**
     * @var array
     */
    protected $eventMappings;

    /**
     * Constructor
     *
     * @param array $eventMappings
     */
    public function __construct($eventMappings)
    {
        $this->eventMappings = $eventMappings;
    }

    /**
     * Get an empty instance of an event
     *
     * @param string $type
     *
     * @return \FreeBet\Bundle\CompetitionBundle\Document\Event
     */
    public function getInstance($type)
    {
        if (!isset($this->eventMappings[$type])) {
            throw new UnsupportedEventType('The event type '.$type.' does not exists');
        }

        $className = $this->eventMappings[$type];
        return new $className();
    }
}
