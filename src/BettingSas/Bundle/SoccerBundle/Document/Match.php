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
}
