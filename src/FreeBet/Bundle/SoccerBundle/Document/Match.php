<?php

namespace FreeBet\Bundle\SoccerBundle\Document;

use FreeBet\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of Event
 *
 * @author jobou
 */
class Match extends Event
{
    use \FreeBet\Bundle\CompetitionBundle\Model\Attribute\LeftTeamScoreAttribute;
    use \FreeBet\Bundle\CompetitionBundle\Model\Attribute\RightTeamScoreAttribute;
    use \FreeBet\Bundle\CompetitionBundle\Model\Attribute\LeftTeamHalfTimeScoreAttribute;
    use \FreeBet\Bundle\CompetitionBundle\Model\Attribute\RightTeamHalfTimeScoreAttribute;
    use \FreeBet\Bundle\CompetitionBundle\Model\Attribute\LeftTeamAfterExtendedTimeScoreAttribute;
    use \FreeBet\Bundle\CompetitionBundle\Model\Attribute\RightTeamAfterExtendedTimeScoreAttribute;
    use \FreeBet\Bundle\CompetitionBundle\Model\Attribute\LeftTeamPenaltyScoreAttribute;
    use \FreeBet\Bundle\CompetitionBundle\Model\Attribute\RightTeamPenaltyScoreAttribute;

    /**
     * @var string $type
     */
    protected $type = "soccer";

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
     * Get leftTeamRealScore
     *
     * @return int $leftTeamRealScore
     */
    public function getLeftTeamRealScore()
    {
        if (!is_null($this->getLeftTeamAfterExtendedTimeScore())) {
            return $this->getLeftTeamAfterExtendedTimeScore();
        } elseif (!is_null($this->getLeftTeamScore())) {
            return $this->getLeftTeamScore();
        }

        return null;
    }

    /**
     * Get rightTeamRealScore
     *
     * @return int $rightTeamRealScore
     */
    public function getRightTeamRealScore()
    {
        if (!is_null($this->getRightTeamAfterExtendedTimeScore())) {
            return $this->getRightTeamAfterExtendedTimeScore();
        } elseif (!is_null($this->getRightTeamScore())) {
            return $this->getRightTeamScore();
        }

        return null;
    }

    /**
     * Is left team winner
     *
     * @return boolean
     */
    public function isLeftTeamWinner()
    {
        return $this->getLeftTeamRealScore() > $this->getRightTeamRealScore();
    }

    /**
     * Is right team winner
     *
     * @return boolean
     */
    public function isRightTeamWinner()
    {
        return $this->getLeftTeamRealScore() < $this->getRightTeamRealScore();
    }

    /**
     * Is no winner : match null
     *
     * @return boolean
     */
    public function isNoWinner()
    {
        return $this->hasResult() && $this->getLeftTeamRealScore() == $this->getRightTeamRealScore();
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
        if ($this->isLeftTeamWinner()) {
            return self::LEFT_TEAM_WIN;
        } elseif ($this->isRightTeamWinner()) {
            return self::RIGHT_TEAM_WIN;
        } elseif ($this->isNoWinner()) {
            return self::BOTH_EQUALS;
        }

        return null;
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
