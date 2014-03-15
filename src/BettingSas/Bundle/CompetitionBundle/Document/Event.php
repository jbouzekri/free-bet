<?php

namespace BettingSas\Bundle\CompetitionBundle\Document;

/**
 * Description of Event
 *
 * @author jobou
 */
abstract class Event
{
    /**
     * Constants used to determine who won the bet
     */
    const LEFT_TEAM_WIN = 0;
    const RIGHT_TEAM_WIN = 1;
    const BOTH_EQUALS = 2;

    /**
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var string $leftName
     */
    protected $leftName;

    /**
     * @var string $rightName
     */
    protected $rightName;

    /**
     * @var boolean $processed
     */
    protected $processed;

    /**
     * @var \DateTime $date
     */
    protected $date;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * @var BettingSas\Bundle\CompetitionBundle\Document\Competition
     */
    protected $competition;

        /**
     * @var date $created
     */
    protected $created;

    /**
     * @var date $updated
     */
    protected $updated;

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
     * Set leftName
     *
     * @param string $leftName
     * @return self
     */
    public function setLeftName($leftName)
    {
        $this->leftName = $leftName;
        return $this;
    }

    /**
     * Get leftName
     *
     * @return string $leftName
     */
    public function getLeftName()
    {
        return $this->leftName;
    }

    /**
     * Set rightName
     *
     * @param string $rightName
     * @return self
     */
    public function setRightName($rightName)
    {
        $this->rightName = $rightName;
        return $this;
    }

    /**
     * Get rightName
     *
     * @return string $rightName
     */
    public function getRightName()
    {
        return $this->rightName;
    }

    /**
     * Set processed
     *
     * @param boolean $processed
     * @return self
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;
        return $this;
    }

    /**
     * Get processed
     *
     * @return boolean $processed
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return self
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set competition
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Competition $competition
     *
     * @return self
     */
    public function setCompetition(\BettingSas\Bundle\CompetitionBundle\Document\Competition $competition)
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * Get competition
     *
     * @return BettingSas\Bundle\CompetitionBundle\Document\Competition $competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Display the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getLeftName().' - '.$this->getRightName();
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
     * Return the id of a service used to guess the form type of the event
     *
     * @return string
     */
    abstract public function getFormTypeGuesserService();

    /**
     * Check if the result is known to process bets
     *
     * @return string
     */
    abstract public function hasResult();

    /**
     * WHen the score is known, check which team won
     * Return :
     *  Event::LEFT_TEAM_WIN if left team won
     *  Event::RIGHT_TEAM_WIN if right team won
     *  EVENT::BOTH_EQUALS if same score
     *
     * @return int
     */
    abstract public function getWinner();

    /**
     * Check if there is at least enough information to display a bet link
     *
     * @return bool
     */
    public function canBet()
    {
        return !$this->getProcessed()
            && !empty($this->leftName)
            && !empty($this->rightName);
    }
}
