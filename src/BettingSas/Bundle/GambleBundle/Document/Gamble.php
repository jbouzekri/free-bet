<?php

namespace BettingSas\Bundle\GambleBundle\Document;

/**
 * Description of Gamble
 *
 * @author jobou
 */
class Gamble
{
    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var boolean $winner
     */
    protected $winner;

    /**
     * @var int $point
     */
    protected $point;

    /**
     * @var BettingSas\Bundle\GambleBundle\Document\Bet
     */
    protected $bets = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bets = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Add bet
     *
     * @param BettingSas\Bundle\GambleBundle\Document\Bet $bet
     */
    public function addBet(\BettingSas\Bundle\GambleBundle\Document\Bet $bet)
    {
        $this->bets[] = $bet;
    }

    /**
     * Remove bet
     *
     * @param BettingSas\Bundle\GambleBundle\Document\Bet $bet
     */
    public function removeBet(\BettingSas\Bundle\GambleBundle\Document\Bet $bet)
    {
        $this->bets->removeElement($bet);
    }

    /**
     * Get bets
     *
     * @return Doctrine\Common\Collections\Collection $bets
     */
    public function getBets()
    {
        return $this->bets;
    }
}
