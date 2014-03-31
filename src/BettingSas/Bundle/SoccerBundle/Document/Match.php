<?php

namespace BettingSas\Bundle\SoccerBundle\Document;

use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of Event
 *
 * @author jobou
 */
class Match extends Event
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
     * @var int $leftTeamHalfTimeScore
     */
    protected $leftTeamHalfTimeScore;

    /**
     * @var int $rightTeamHalfTimeScore
     */
    protected $rightTeamHalfTimeScore;

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
     * Set leftTeamHalfTimeScore
     *
     * @param int $leftTeamHalfTimeScore
     * @return self
     */
    public function setLeftTeamHalfTimeScore($leftTeamHalfTimeScore)
    {
        $this->leftTeamHalfTimeScore = $leftTeamHalfTimeScore;
        return $this;
    }

    /**
     * Get leftTeamHalfTimeScore
     *
     * @return int $leftTeamHalfTimeScore
     */
    public function getLeftTeamHalfTimeScore()
    {
        return $this->leftTeamHalfTimeScore;
    }

    /**
     * Set rightTeamHalfTimeScore
     *
     * @param int $rightTeamHalfTimeScore
     * @return self
     */
    public function setRightTeamHalfTimeScore($rightTeamHalfTimeScore)
    {
        $this->rightTeamHalfTimeScore = $rightTeamHalfTimeScore;
        return $this;
    }

    /**
     * Get rightTeamHalfTimeScore
     *
     * @return int $rightTeamHalfTimeScore
     */
    public function getRightTeamHalfTimeScore()
    {
        return $this->rightTeamHalfTimeScore;
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
     * Get leftTeamRealScore
     *
     * @return int $leftTeamRealScore
     */
    public function getLeftTeamRealScore()
    {
        if (is_null($this->getLeftTeamScore())) {
            return null;
        }

        return $this->getLeftTeamScore() + $this->getLeftTeamAfterExtendedTimeScore();
    }

    /**
     * Get rightTeamRealScore
     *
     * @return int $rightTeamRealScore
     */
    public function getRightTeamRealScore()
    {
        if (is_null($this->getRightTeamScore())) {
            return null;
        }

        return $this->getRightTeamScore() + $this->getRightTeamAfterExtendedTimeScore();
    }

    /**
     * @return mixed
     *
     * true : left team win
     * 0 : match null
     * false : right team win
     * null  match not played
     */
    public function getWinner()
    {
        if ($this->getLeftTeamRealScore() > $this->getRightTeamRealScore()) {
            return Event::LEFT_TEAM_WIN;
        } elseif ($this->getLeftTeamRealScore() < $this->getRightTeamRealScore()) {
            return Event::RIGHT_TEAM_WIN;
        } elseif ($this->getLeftTeamRealScore() == $this->getRightTeamRealScore()
            && !is_null($this->getLeftTeamRealScore())
            && !is_null($this->getRightTeamRealScore())
        ) {
            return Event::BOTH_EQUALS;
        }

        return null;
    }

    /**
     * Check if result is known
     *
     * @return bool
     */
    public function isFinished()
    {
        return !is_null($this->getLeftTeamScore()) || !is_null($this->getRightTeamScore());
    }

    /**
     * {@inheritDoc}
     */
    public function getFormType()
    {
        return 'match';
    }

    /**
     * {@inheritDoc}
     */
    public function hasResult()
    {
        return $this->getLeftTeamRealScore() !== null && $this->getRightTeamRealScore() !== null;
    }
}
