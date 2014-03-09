<?php

namespace BettingSas\Bundle\GambleBundle\Manager;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Gamble\GambleInterface;
use BettingSas\Bundle\GambleBundle\Exception\UnsupportedEventType;
use BettingSas\Bundle\GambleBundle\Exception\GambleException;
use BettingSas\Bundle\GambleBundle\Gamble\GambleChain;

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
    protected $configuration;

    /**
     * Constructor
     *
     * @param array $configuration
     */
    public function __construct(GambleChain $configuration)
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
            throw new UnsupportedEventType($type. ' not supported. Try '.implode(', ', array_keys($this->configuration)));
        }

        $gambles = array();

        $gambleClasses = $this->configuration[$type];
        foreach ($gambleClasses as $key => $gambleClass) {
            $gamble = new $gambleClass();
            if (!$gamble instanceof GambleInterface) {
                throw new GambleException($gambleClass." is not an instance of GambleInterface");
            }
            $gambles[] = $gamble;
        }

        return $gambles;
    }
}
