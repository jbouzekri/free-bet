<?php

namespace BettingSas\Bundle\SoccerBundle\Document;

use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of Event
 *
 * @author jobou
 */
abstract class Match extends Event
{
    /**
     * @var string $type
     */
    protected $type = "soccer";

    /**
     * @var int $leftTeamScore
     */
    protected $leftTeamScore;

    /**
     * @var int $rightTeamScore
     */
    protected $rightTeamScore;

    /**
     * @var int $leftTeamRealScore
     */
    protected $leftTeamRealScore;

    /**
     * @var int $rightTeamRealScore
     */
    protected $rightTeamRealScore;

    /**
     * Set leftTeamScore
     *
     * @param int $leftTeamScore
     * @return self
     */
    public function setLeftTeamScore($leftTeamScore)
    {
        $this->leftTeamScore = $leftTeamScore;
        return $this;
    }

    /**
     * Get leftTeamScore
     *
     * @return int $leftTeamScore
     */
    public function getLeftTeamScore()
    {
        return $this->leftTeamScore;
    }

    /**
     * Set rightTeamScore
     *
     * @param int $rightTeamScore
     * @return self
     */
    public function setRightTeamScore($rightTeamScore)
    {
        $this->rightTeamScore = $rightTeamScore;
        return $this;
    }

    /**
     * Get rightTeamScore
     *
     * @return int $rightTeamScore
     */
    public function getRightTeamScore()
    {
        return $this->rightTeamScore;
    }

    /**
     * Set leftTeamRealScore
     *
     * @param int $leftTeamRealScore
     * @return self
     */
    public function setLeftTeamRealScore($leftTeamRealScore)
    {
        $this->leftTeamRealScore = $leftTeamRealScore;
        return $this;
    }

    /**
     * Get leftTeamRealScore
     *
     * @return int $leftTeamRealScore
     */
    public function getLeftTeamRealScore()
    {
        return $this->leftTeamRealScore;
    }

    /**
     * Set rightTeamRealScore
     *
     * @param int $rightTeamRealScore
     * @return self
     */
    public function setRightTeamRealScore($rightTeamRealScore)
    {
        $this->rightTeamRealScore = $rightTeamRealScore;
        return $this;
    }

    /**
     * Get rightTeamRealScore
     *
     * @return int $rightTeamRealScore
     */
    public function getRightTeamRealScore()
    {
        return $this->rightTeamRealScore;
    }
}
