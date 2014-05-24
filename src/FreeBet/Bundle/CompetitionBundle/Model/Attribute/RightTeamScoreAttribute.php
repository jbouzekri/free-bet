<?php

namespace FreeBet\Bundle\CompetitionBundle\Model\Attribute;

/**
 * Description of RightTeamScoreAttribute
 *
 * @author jobou
 */
trait RightTeamScoreAttribute
{
    /**
     * @var int $rightTeamScore
     */
    protected $rightTeamScore;

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
