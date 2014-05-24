<?php

namespace FreeBet\Bundle\CompetitionBundle\Model\Attribute;

/**
 * Description of LeftTeamScoreAttribute
 *
 * @author jobou
 */
trait LeftTeamHalfTimeScoreAttribute
{
    /**
     * @var int $leftTeamHalfTimeScore
     */
    protected $leftTeamHalfTimeScore;

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
}
