<?php

namespace FreeBet\Bundle\CompetitionBundle\Model\Attribute;

/**
 * Description of RightTeamAfterExtendedTimeScoreAttribute
 *
 * @author jobou
 */
trait RightTeamAfterExtendedTimeScoreAttribute
{
    /**
     * @var int $rightTeamAfterExtendedTimeScore
     */
    protected $rightTeamAfterExtendedTimeScore;

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
}
