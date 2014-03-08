<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\Document;

use BettingSas\Bundle\SoccerBundle\Document\Match as BaseMatch;

/**
 * Description of Event
 *
 * @author jobou
 */
class Match extends BaseMatch
{
    /**
     * @var int $phaseOrder
     */
    protected $phaseOrder;

    /**
     * @var string $phase
     */
    protected $phase;

    /**
     * @var string $group
     */
    protected $group;

    /**
     * @var int $leftTeamAfterExtendedTimeScore
     */
    protected $leftTeamAfterExtendedTimeScore;

    /**
     * @var int $rightTeamAfterExtendedTimeScore
     */
    protected $rightTeamAfterExtendedTimeScore;

    /**
     * @var int $leftTeamPenaltyScore
     */
    protected $leftTeamPenaltyScore;

    /**
     * @var int $rightTeamPenaltyScore
     */
    protected $rightTeamPenaltyScore;

    /**
     * Set phaseOrder
     *
     * @param int $phaseOrder
     * @return self
     */
    public function setPhaseOrder($phaseOrder)
    {
        $this->phaseOrder = $phaseOrder;
        return $this;
    }

    /**
     * Get phaseOrder
     *
     * @return int $phaseOrder
     */
    public function getPhaseOrder()
    {
        return $this->phaseOrder;
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
     * Set leftTeamAfterExtendedTimeScore
     *
     * @param int $leftTeamAfterExtendedTimeScore
     * @return self
     */
    public function setLeftTeamAfterExtendedTimeScore($leftTeamAfterExtendedTimeScore)
    {
        $this->leftTeamAfterExtendedTimeScore = $leftTeamAfterExtendedTimeScore;
        return $this;
    }

    /**
     * Get leftTeamAfterExtendedTimeScore
     *
     * @return int $leftTeamAfterExtendedTimeScore
     */
    public function getLeftTeamAfterExtendedTimeScore()
    {
        return $this->leftTeamAfterExtendedTimeScore;
    }

    /**
     * Set rightTeamAfterExtendedTimeScore
     *
     * @param int $rightTeamAfterExtendedTimeScore
     * @return self
     */
    public function setRightTeamAfterExtendedTimeScore($rightTeamAfterExtendedTimeScore)
    {
        $this->rightTeamAfterExtendedTimeScore = $rightTeamAfterExtendedTimeScore;
        return $this;
    }

    /**
     * Get rightTeamAfterExtendedTimeScore
     *
     * @return int $rightTeamAfterExtendedTimeScore
     */
    public function getRightTeamAfterExtendedTimeScore()
    {
        return $this->rightTeamAfterExtendedTimeScore;
    }

    /**
     * Set leftTeamPenaltyScore
     *
     * @param int $leftTeamPenaltyScore
     * @return self
     */
    public function setLeftTeamPenaltyScore($leftTeamPenaltyScore)
    {
        $this->leftTeamPenaltyScore = $leftTeamPenaltyScore;
        return $this;
    }

    /**
     * Get leftTeamPenaltyScore
     *
     * @return int $leftTeamPenaltyScore
     */
    public function getLeftTeamPenaltyScore()
    {
        return $this->leftTeamPenaltyScore;
    }

    /**
     * Set rightTeamPenaltyScore
     *
     * @param int $rightTeamPenaltyScore
     * @return self
     */
    public function setRightTeamPenaltyScore($rightTeamPenaltyScore)
    {
        $this->rightTeamPenaltyScore = $rightTeamPenaltyScore;
        return $this;
    }

    /**
     * Get rightTeamPenaltyScore
     *
     * @return int $rightTeamPenaltyScore
     */
    public function getRightTeamPenaltyScore()
    {
        return $this->rightTeamPenaltyScore;
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
