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
     * @var MongoId $id
     */
    protected $id;

    /**
     * @var string $type
     */
    protected $type;

    /**
     * @var string $left_name
     */
    protected $left_name;

    /**
     * @var string $right_name
     */
    protected $right_name;

    /**
     * @var int $processed
     */
    protected $processed;

    /**
     * @var timestamp $date
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
        $this->left_name = $leftName;
        return $this;
    }

    /**
     * Get leftName
     *
     * @return string $leftName
     */
    public function getLeftName()
    {
        return $this->left_name;
    }

    /**
     * Set rightName
     *
     * @param string $rightName
     * @return self
     */
    public function setRightName($rightName)
    {
        $this->right_name = $rightName;
        return $this;
    }

    /**
     * Get rightName
     *
     * @return string $rightName
     */
    public function getRightName()
    {
        return $this->right_name;
    }

    /**
     * Set processed
     *
     * @param int $processed
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
     * @return int $processed
     */
    public function getProcessed()
    {
        return $this->processed;
    }

    /**
     * Set date
     *
     * @param timestamp $date
     * @return self
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return timestamp $date
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
     * @param BettingSas\Bundle\CompetitionBundle\Document\Competition $competition
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
}
