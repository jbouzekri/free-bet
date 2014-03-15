<?php

namespace BettingSas\Bundle\GambleBundle\Gamble;

use BettingSas\Bundle\CompetitionBundle\Exception\UnsupportedEventType;
use BettingSas\Bundle\GambleBundle\Exception\UnsupportedGambleType;

class GambleChain
{
    /**
     * @var array
     */
    private $gambles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gambles = array();
    }

    /**
     * Get all gambles configured for a type
     *
     * @param string $type
     *
     * @return array
     *
     * @throws UnsupportedEventType
     */
    public function getGamblesByEventType($type)
    {
        if (!isset($this->gambles[$type])) {
            throw new UnsupportedEventType($type. ' not supported. Try '.implode(', ', array_keys($this->gambles)));
        }

        return $this->gambles[$type];
    }

    /**
     * Get all gambles configured for a type
     *
     * @param string $eventType
     * @param string $gambleType
     *
     * @return \BettingSas\Bundle\GambleBundle\Gamble\GambleInterface
     *
     * @throws UnsupportedEventType
     */
    public function getGambleByEventTypeAndType($eventType, $gambleType)
    {
        if (!isset($this->gambles[$eventType])) {
            throw new UnsupportedEventType(
                $eventType. ' not supported. Try '.implode(', ', array_keys($this->gambles))
            );
        }

        $availableType = array();
        foreach ($this->gambles[$eventType] as $gamble) {
            $availableType[] = $gamble->getName();
            if ($gamble->getName() == $gambleType) {
                return $gamble;
            }
        }

        throw new UnsupportedGambleType(
            $gambleType. ' not supported for event '.$eventType.'. Try '.implode(', ', $availableType)
        );
    }

    /**
     * Get gambles
     *
     * @return array
     */
    public function getGambles()
    {
        return $this->gambles;
    }

    /**
     * Register a new gamble type
     *
     * @param \BettingSas\Bundle\GambleBundle\Gamble\GambleInterface $gamble
     * @param string $type
     * @param int $order
     */
    public function addGamble(GambleInterface $gamble, $type, $order = null)
    {
        if (!isset($this->gambles[$type])) {
            $this->gambles[$type] = array();
        }

        if (is_int($order)) {
            $this->gambles[$type][$order] = $gamble;
        } else {
            array_push($this->gambles[$type], $gamble);
        }

        $this->sort();
    }

    /**
     * Sort the gambles array
     */
    public function sort()
    {
        foreach (array_keys($this->gambles) as $type) {
            ksort($this->gambles[$type]);
        }
    }
}
