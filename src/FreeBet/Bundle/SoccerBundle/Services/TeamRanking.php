<?php

namespace FreeBet\Bundle\SoccerBundle\Services;

/**
 * TeamRanking
 *
 * @author jobou
 */
class TeamRanking
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $point = 0;

    /**
     * @var int
     */
    protected $goalScored = 0;

    /**
     * @var int
     */
    protected $goalTaken = 0;

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get point
     *
     * @return int
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Add point
     *
     * @param int $point
     * @return \FreeBet\Bundle\SoccerBundle\Services\TeamRanking
     */
    public function addPoint($point)
    {
        $this->point += $point;

        return $this;
    }

    /**
     * Get goalScored
     *
     * @return int
     */
    public function getGoalScored()
    {
        return $this->goalScored;
    }

    /**
     * Add goalScored
     *
     * @param int $goalScored
     * @return \FreeBet\Bundle\SoccerBundle\Services\TeamRanking
     */
    public function addGoalScored($goalScored)
    {
        $this->goalScored += $goalScored;

        return $this;
    }

    /**
     * Get goalTaken
     *
     * @return int
     */
    public function getGoalTaken()
    {
        return $this->goalTaken;
    }

    /**
     * Add goalTaken
     *
     * @param int $goalTaken
     * @return \FreeBet\Bundle\SoccerBundle\Services\TeamRanking
     */
    public function addGoalTaken($goalTaken)
    {
        $this->goalTaken += $goalTaken;

        return $this;
    }

    /**
     * Get diff
     *
     * @return int
     */
    public function getDiff()
    {
        return $this->getGoalScored() - $this->getGoalTaken();
    }
}
