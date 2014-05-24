<?php

namespace FreeBet\Bundle\CompetitionBundle\Model\Attribute;

/**
 * Description of RightTeamPenaltyScoreAttribute
 *
 * @author jobou
 */
trait RightTeamPenaltyScoreAttribute
{
    /**
     * @var int $rightTeamPenaltyScore
     */
    protected $rightTeamPenaltyScore;

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
}
