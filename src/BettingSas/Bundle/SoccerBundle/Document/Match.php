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
     * @var int $left_team_score
     */
    protected $left_team_score;

    /**
     * @var int $right_team_score
     */
    protected $right_team_score;

    /**
     * @var int $left_team_real_score
     */
    protected $left_team_real_score;

    /**
     * @var int $right_team_real_score
     */
    protected $right_team_real_score;

    /**
     * Set leftTeamScore
     *
     * @param int $leftTeamScore
     * @return self
     */
    public function setLeftTeamScore($leftTeamScore)
    {
        $this->left_team_score = $leftTeamScore;
        return $this;
    }

    /**
     * Get leftTeamScore
     *
     * @return int $leftTeamScore
     */
    public function getLeftTeamScore()
    {
        return $this->left_team_score;
    }

    /**
     * Set rightTeamScore
     *
     * @param int $rightTeamScore
     * @return self
     */
    public function setRightTeamScore($rightTeamScore)
    {
        $this->right_team_score = $rightTeamScore;
        return $this;
    }

    /**
     * Get rightTeamScore
     *
     * @return int $rightTeamScore
     */
    public function getRightTeamScore()
    {
        return $this->right_team_score;
    }

    /**
     * Set leftTeamRealScore
     *
     * @param int $leftTeamRealScore
     * @return self
     */
    public function setLeftTeamRealScore($leftTeamRealScore)
    {
        $this->left_team_real_score = $leftTeamRealScore;
        return $this;
    }

    /**
     * Get leftTeamRealScore
     *
     * @return int $leftTeamRealScore
     */
    public function getLeftTeamRealScore()
    {
        return $this->left_team_real_score;
    }

    /**
     * Set rightTeamRealScore
     *
     * @param int $rightTeamRealScore
     * @return self
     */
    public function setRightTeamRealScore($rightTeamRealScore)
    {
        $this->right_team_real_score = $rightTeamRealScore;
        return $this;
    }

    /**
     * Get rightTeamRealScore
     *
     * @return int $rightTeamRealScore
     */
    public function getRightTeamRealScore()
    {
        return $this->right_team_real_score;
    }
}
