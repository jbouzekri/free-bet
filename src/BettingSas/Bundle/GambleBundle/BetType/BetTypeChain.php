<?php

namespace BettingSas\Bundle\GambleBundle\BetType;

use BettingSas\Bundle\CompetitionBundle\Exception\UnsupportedEventType;
use BettingSas\Bundle\GambleBundle\Exception\UnsupportedBetType;

class BetTypeChain
{
    /**
     * @var array
     */
    private $betTypes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->betTypes = array();
    }

    /**
     * Get all types of bet available for a type of event
     *
     * @param string $type
     *
     * @return array
     *
     * @throws UnsupportedEventType
     */
    public function findByEventType($type)
    {
        if (!isset($this->betTypes[$type])) {
            throw new UnsupportedEventType($type. ' not supported. Try '.implode(', ', array_keys($this->betTypes)));
        }

        return $this->betTypes[$type];
    }

    /**
     * Get the bet type entity with a bet type code and an event type
     *
     * @param string $eventType
     * @param string $betType
     *
     * @return \BettingSas\Bundle\GambleBundle\BetType\BetTypeInterface
     *
     * @throws UnsupportedBetType
     */
    public function findByEventTypeAndType($eventType, $betType)
    {
        $betTypesOnEvent = $this->findByEventType($eventType);

        $availableType = array();
        foreach ($betTypesOnEvent as $betTypeEntity) {
            $availableType[] = $betTypeEntity->getName();
            if ($betTypeEntity->getName() == $betType) {
                return $betTypeEntity;
            }
        }

        throw new UnsupportedBetType(
            $betType. ' not supported for event '.$eventType.'. Try '.implode(', ', $availableType)
        );
    }

    /**
     * Get all types of bet
     *
     * @return array
     */
    public function getBetTypes()
    {
        return $this->betTypes;
    }

    /**
     * Register a new type of bet
     *
     * @param \BettingSas\Bundle\GambleBundle\BetType\BetTypeInterface $gamble
     * @param string $type
     * @param int $order
     */
    public function addBetType(BetTypeInterface $gamble, $type, $order = null)
    {
        if (!isset($this->betTypes[$type])) {
            $this->betTypes[$type] = array();
        }

        if (is_int($order)) {
            $this->betTypes[$type][$order] = $gamble;
        } else {
            array_push($this->betTypes[$type], $gamble);
        }

        $this->sort();
    }

    /**
     * Sort the array of bet types
     */
    public function sort()
    {
        foreach (array_keys($this->betTypes) as $type) {
            ksort($this->betTypes[$type]);
        }
    }
}
