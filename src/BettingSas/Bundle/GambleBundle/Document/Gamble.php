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
     * @var date $processedDate
     */
    protected $processedDate;

    /**
     * @var date $created
     */
    protected $created;

    /**
     * @var date $updated
     */
    protected $updated;

    /**
     * @var \BettingSas\Bundle\UserBundle\Document\User
     */
    protected $user;

    /**
     * @var \BettingSas\Bundle\UserBundle\Document\Organization
     */
    protected $organization;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    protected $bets;

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
     * @param \BettingSas\Bundle\GambleBundle\Document\Bet $bet
     */
    public function addBet(\BettingSas\Bundle\GambleBundle\Document\Bet $bet)
    {
        $this->bets[] = $bet;
    }

    /**
     * Remove bet
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Bet $bet
     */
    public function removeBet(\BettingSas\Bundle\GambleBundle\Document\Bet $bet)
    {
        $this->bets->removeElement($bet);
    }

    /**
     * Get bets
     *
     * @return \Doctrine\Common\Collections\Collection $bets
     */
    public function getBets()
    {
        return $this->bets;
    }

    /**
     * Set processedDate
     *
     * @param date $processedDate
     * @return self
     */
    public function setProcessedDate($processedDate)
    {
        $this->processedDate = $processedDate;
        return $this;
    }

    /**
     * Get processedDate
     *
     * @return date $processedDate
     */
    public function getProcessedDate()
    {
        return $this->processedDate;
    }

    /**
     * Set user
     *
     * @param \BettingSas\Bundle\UserBundle\Document\User $user
     * @return self
     */
    public function setUser(\BettingSas\Bundle\UserBundle\Document\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \BettingSas\Bundle\UserBundle\Document\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set organization
     *
     * @param \BettingSas\Bundle\UserBundle\Model\Organization $organization
     * @return self
     */
    public function setOrganization(\BettingSas\Bundle\UserBundle\Model\Organization $organization = null)
    {
        $this->organization = $organization;
        return $this;
    }

    /**
     * Get organization
     *
     * @return \BettingSas\Bundle\UserBundle\Model\Organization $organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }



    /**
     * Set created
     *
     * @param date $created
     * @return self
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return date $created
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param date $updated
     * @return self
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return date $updated
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Find all bets having an event
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function findBetsWithEvent(\BettingSas\Bundle\CompetitionBundle\Document\Event $event)
    {
        $betsWithEvent = new \Doctrine\Common\Collections\ArrayCollection();

        foreach ($this->getBets() as $bet) {
            if ($bet->getEvent()->getId() == $event->getId()) {
                $betsWithEvent->add($bet);
            }
        }

        return $betsWithEvent;
    }

    /**
     * Check if the gamble has ended
     * All bets have been processed
     *
     * @return boolean
     */
    public function hasEnded()
    {
        foreach ($this->getBets() as $bet) {
            if (is_null($bet->getWinner())) {
                return false;
            }
        }

        return true;
    }

    /**
     * Fill the winner field in the gamble according to the one in the bets
     *
     * @return \BettingSas\Bundle\GambleBundle\Document\Gamble
     */
    public function fillWinner()
    {
        $this->setWinner(true);
        foreach ($this->getBets() as $bet) {
            if ($bet->getWinner() === false) {
                $this->setWinner(false);
                break;
            }
        }

        return $this;
    }
}
