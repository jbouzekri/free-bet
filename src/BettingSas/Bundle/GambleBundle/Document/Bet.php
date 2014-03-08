<?php

namespace BettingSas\Bundle\GambleBundle\Document;

/**
 * Description of Bet
 *
 * @author jobou
 */
class Bet
{
    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var string $configuration
     */
    protected $configuration;

    /**
     * @var boolean $winner
     */
    protected $winner;

    /**
     * @var int $point
     */
    protected $point;

    /**
     * @var BettingSas\Bundle\CompetitionBundle\Document\Event
     */
    protected $event;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set configuration
     *
     * @param string $configuration
     * @return self
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
        return $this;
    }

    /**
     * Get configuration
     *
     * @return string $configuration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * Set winner
     *
     * @param boolean $winner
     * @return self
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
        return $this;
    }

    /**
     * Get winner
     *
     * @return boolean $winner
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Set point
     *
     * @param int $point
     * @return self
     */
    public function setPoint($point)
    {
        $this->point = $point;
        return $this;
    }

    /**
     * Get point
     *
     * @return int $point
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Set event
     *
     * @param BettingSas\Bundle\CompetitionBundle\Document\Event $event
     * @return self
     */
    public function setEvent(\BettingSas\Bundle\CompetitionBundle\Document\Event $event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * Get event
     *
     * @return BettingSas\Bundle\CompetitionBundle\Document\Event $event
     */
    public function getEvent()
    {
        return $this->event;
    }
}
