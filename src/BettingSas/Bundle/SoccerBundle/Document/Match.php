<?php

namespace BettingSas\Bundle\SoccerBundle\Document;

/**
 * Description of Event
 *
 * @author jobou
 */
abstract class Match
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
     * @var string $left_team_name
     */
    protected $left_team_name;

    /**
     * @var string $right_team_name
     */
    protected $right_team_name;

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
     * @var string $sport
     */
    protected $sport = "soccer";

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
     * Set phaseOrder
     *
     * @param int $phaseOrder
     * @return self
     */
    public function setPhaseOrder($phaseOrder)
    {
        $this->phase_order = $phaseOrder;
        return $this;
    }

    /**
     * Get phaseOrder
     *
     * @return int $phaseOrder
     */
    public function getPhaseOrder()
    {
        return $this->phase_order;
    }

    /**
     * Set phase
     *
     * @param string $phase
     * @return self
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;
        return $this;
    }

    /**
     * Get phase
     *
     * @return string $phase
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * Set group
     *
     * @param string $group
     * @return self
     */
    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    /**
     * Get group
     *
     * @return string $group
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set leftTeamName
     *
     * @param string $leftTeamName
     * @return self
     */
    public function setLeftTeamName($leftTeamName)
    {
        $this->left_team_name = $leftTeamName;
        return $this;
    }

    /**
     * Get leftTeamName
     *
     * @return string $leftTeamName
     */
    public function getLeftTeamName()
    {
        return $this->left_team_name;
    }

    /**
     * Set rightTeamName
     *
     * @param string $rightTeamName
     * @return self
     */
    public function setRightTeamName($rightTeamName)
    {
        $this->right_team_name = $rightTeamName;
        return $this;
    }

    /**
     * Get rightTeamName
     *
     * @return string $rightTeamName
     */
    public function getRightTeamName()
    {
        return $this->right_team_name;
    }

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
     * Set leftTeamAfterExtendedTimeScore
     *
     * @param int $leftTeamAfterExtendedTimeScore
     * @return self
     */
    public function setLeftTeamAfterExtendedTimeScore($leftTeamAfterExtendedTimeScore)
    {
        $this->left_team_after_extended_time_score = $leftTeamAfterExtendedTimeScore;
        return $this;
    }

    /**
     * Get leftTeamAfterExtendedTimeScore
     *
     * @return int $leftTeamAfterExtendedTimeScore
     */
    public function getLeftTeamAfterExtendedTimeScore()
    {
        return $this->left_team_after_extended_time_score;
    }

    /**
     * Set rightTeamAfterExtendedTimeScore
     *
     * @param int $rightTeamAfterExtendedTimeScore
     * @return self
     */
    public function setRightTeamAfterExtendedTimeScore($rightTeamAfterExtendedTimeScore)
    {
        $this->right_team_after_extended_time_score = $rightTeamAfterExtendedTimeScore;
        return $this;
    }

    /**
     * Get rightTeamAfterExtendedTimeScore
     *
     * @return int $rightTeamAfterExtendedTimeScore
     */
    public function getRightTeamAfterExtendedTimeScore()
    {
        return $this->right_team_after_extended_time_score;
    }

    /**
     * Set leftTeamPenaltyScore
     *
     * @param int $leftTeamPenaltyScore
     * @return self
     */
    public function setLeftTeamPenaltyScore($leftTeamPenaltyScore)
    {
        $this->left_team_penalty_score = $leftTeamPenaltyScore;
        return $this;
    }

    /**
     * Get leftTeamPenaltyScore
     *
     * @return int $leftTeamPenaltyScore
     */
    public function getLeftTeamPenaltyScore()
    {
        return $this->left_team_penalty_score;
    }

    /**
     * Set rightTeamPenaltyScore
     *
     * @param int $rightTeamPenaltyScore
     * @return self
     */
    public function setRightTeamPenaltyScore($rightTeamPenaltyScore)
    {
        $this->right_team_penalty_score = $rightTeamPenaltyScore;
        return $this;
    }

    /**
     * Get rightTeamPenaltyScore
     *
     * @return int $rightTeamPenaltyScore
     */
    public function getRightTeamPenaltyScore()
    {
        return $this->right_team_penalty_score;
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
     * Set sport
     *
     * @param string $sport
     * @return self
     */
    public function setSport($sport)
    {
        $this->sport = $sport;
        return $this;
    }

    /**
     * Get sport
     *
     * @return string $sport
     */
    public function getSport()
    {
        return $this->sport;
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

    /**
     * @return mixed
     *
     * true : left team win
     * 0 : match null
     * false : right team win
     * null  match not played
     */
    public function isLeftTeamWin()
    {
        if (is_null($this->getLeftTeamRealScore()) || is_null($this->getRightTeamRealScore())) {
            return null;
        } elseif ($this->getLeftTeamRealScore() > $this->getRightTeamRealScore()) {
            return true;
        } elseif ($this->getLeftTeamRealScore() < $this->getRightTeamRealScore()) {
            return false;
        } elseif ($this->getLeftTeamRealScore() == $this->getRightTeamRealScore()) {
            return 0;
        }

        return null;
    }
}
