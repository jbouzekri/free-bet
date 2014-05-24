<?php

namespace FreeBet\Bundle\CompetitionBundle\Model\Attribute;

/**
 * Description of LeftTeamAfterExtendedTimeScoreAttribute
 *
 * @author jobou
 */
trait LeftTeamAfterExtendedTimeScoreAttribute
{
    /**
     * @var int $leftTeamAfterExtendedTimeScore
     */
    protected $leftTeamAfterExtendedTimeScore;

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
}
