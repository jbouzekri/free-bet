<?php

namespace FreeBet\Bundle\CompetitionBundle\Model\Attribute;

/**
 * Description of RightTeamHalfTimeScoreAttribute
 *
 * @author jobou
 */
trait RightTeamHalfTimeScoreAttribute
{
    /**
     * @var int $rightTeamHalfTimeScore
     */
    protected $rightTeamHalfTimeScore;

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
}
