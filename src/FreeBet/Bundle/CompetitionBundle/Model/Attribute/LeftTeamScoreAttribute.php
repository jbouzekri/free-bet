<?php

namespace FreeBet\Bundle\CompetitionBundle\Model\Attribute;

/**
 * Description of LeftTeamScoreAttribute
 *
 * @author jobou
 */
trait LeftTeamScoreAttribute
{
    /**
     * @var int $leftTeamScore
     */
    protected $leftTeamScore;

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
}
