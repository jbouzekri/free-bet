<?php

namespace FreeBet\Bundle\GambleBundle\Document;

use FreeBet\Bundle\UserBundle\Model\User;

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
     * @var \FreeBet\Bundle\UserBundle\Document\User
     */
    protected $user;

    /**
     * @var \FreeBet\Bundle\UserBundle\Document\Organization
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
     * @param \FreeBet\Bundle\GambleBundle\Document\Bet $bet
     */
    public function addBet(\FreeBet\Bundle\GambleBundle\Document\Bet $bet)
    {
        $this->bets[] = $bet;
    }

    /**
     * Remove bet
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Bet $bet
     */
    public function removeBet(\FreeBet\Bundle\GambleBundle\Document\Bet $bet)
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
     * @param \DateTime $processedDate
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
     * @return \DateTime $processedDate
     */
    public function getProcessedDate()
    {
        return $this->processedDate;
    }

    /**
     * Set user
     *
     * @param \FreeBet\Bundle\UserBundle\Document\User $user
     * @return self
     */
    public function setUser(\FreeBet\Bundle\UserBundle\Document\User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \FreeBet\Bundle\UserBundle\Document\User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set organization
     *
     * @param \FreeBet\Bundle\UserBundle\Model\Organization $organization
     * @return self
     */
    public function setOrganization(\FreeBet\Bundle\UserBundle\Model\Organization $organization = null)
    {
        $this->organization = $organization;
        return $this;
    }

    /**
     * Get organization
     *
     * @return \FreeBet\Bundle\UserBundle\Model\Organization $organization
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
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function findBetsWithEvent(\FreeBet\Bundle\CompetitionBundle\Document\Event $event)
    {
        return $this->getBets()->filter(function (Bet $bet) use ($event) {
            return $bet->getEvent()->getId() == $event->getId();
        });
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
     * @return \FreeBet\Bundle\GambleBundle\Document\Gamble
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

    /**
     * Get the name of a gamble
     *
     * @return string
     */
    public function getName()
    {
        $eventNames = $this->getBets()->map(function (Bet $bet) {
            return $bet->getEvent()->getName();
        });

        return implode(', ', $eventNames->toArray());
    }

    /**
     * Get all winning bets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWinningBets()
    {
        return $this->getBets()->filter(function (Bet $bet) {
            return $bet->getWinner();
        });
    }

    /**
     * Get all losing bets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLosingBets()
    {
        return $this->getBets()->filter(function (Bet $bet) {
            return $bet->getWinner() === false;
        });
    }

    /**
     * Check if a user can delete the gamble
     *
     * @param \FreeBet\Bundle\UserBundle\Model\User $user
     *
     * @return boolean
     */
    public function canDelete(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($this->isOwner($user) && $this->canDeleteAllBet()) {
            return true;
        }

        return false;
    }

    /**
     * Check if the bets can be deleted (the event has not started)
     *
     * @return boolean
     */
    public function canDeleteAllBet()
    {
        $notDeletableBets = $this->getBets()->filter(function (Bet $bet) {
            return $bet->canDelete() === false;
        });

        return $notDeletableBets->count() === 0;
    }

    /**
     * Check if the gamble is owned by the user
     *
     * @param \FreeBet\Bundle\UserBundle\Model\User $user
     *
     * @return boolean
     */
    public function isOwner(User $user)
    {
        return $user->getId() === $this->getUser()->getId();
    }
}
