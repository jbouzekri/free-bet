<?php

namespace FreeBet\Bundle\GambleBundle\Document;

/**
 * Description of Bet
 *
 * @author jobou
 */
class Bet
{
    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var string $choice
     */
    protected $choice;

    /**
     * @var FreeBet\Bundle\CompetitionBundle\Document\Event
     */
    protected $event;

    /**
     * @var boolean $winner
     */
    protected $winner;

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
     * Set choice
     *
     * @param string $choice
     * @return self
     */
    public function setChoice($choice)
    {
        $this->choice = $choice;
        return $this;
    }

    /**
     * Get choice
     *
     * @return string $choice
     */
    public function getChoice()
    {
        return $this->choice;
    }

    /**
     * Set event
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     * @return self
     */
    public function setEvent(\FreeBet\Bundle\CompetitionBundle\Document\Event $event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * Get event
     *
     * @return FreeBet\Bundle\CompetitionBundle\Document\Event $event
     */
    public function getEvent()
    {
        return $this->event;
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
     * Check if the bet can be removed (event not started)
     *
     * @return boolean
     */
    public function canDelete()
    {
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        if ($this->isEventStarted()) {
            return true;
        }

        return false;
    }

    /**
     * Check if the event has started
     *
     * @return boolean
     */
    public function isEventStarted()
    {
        return $this->getEvent()->isStarted();
    }
}
