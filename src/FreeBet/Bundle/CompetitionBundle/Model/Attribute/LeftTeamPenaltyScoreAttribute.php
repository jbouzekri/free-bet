<?php

namespace FreeBet\Bundle\CompetitionBundle\Model\Attribute;

/**
 * Description of LeftTeamPenaltyScoreAttribute
 *
 * @author jobou
 */
trait LeftTeamPenaltyScoreAttribute
{
    /**
     * @var int $leftTeamPenaltyScore
     */
    protected $leftTeamPenaltyScore;

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
}
