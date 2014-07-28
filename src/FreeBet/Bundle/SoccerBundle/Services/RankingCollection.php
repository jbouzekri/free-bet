<?php

namespace FreeBet\Bundle\SoccerBundle\Services;

use FreeBet\Bundle\SoccerBundle\Document\Match;

/**
 * RankingCollection
 *
 * @author jobou
 */
class RankingCollection implements \Iterator
{
    /**
     * @var int
     */
    protected $position = 0;

    /**
     * Raking collection
     *
     * @var array
     */
    protected $rankings = array();

    /**
     * @var \FreeBet\Bundle\CompetitionBundle\Document\Competition
     */
    protected $competition = null;

    /**
     * Get a team ranking
     *
     * @param string $name
     * @return \FreeBet\Bundle\SoccerBundle\Services\TeamRanking
     */
    public function getTeam($name)
    {
        if (!isset($this->rankings[$name])) {
            $this->rankings[$name] = $this->createRanking($name);
        }

        return $this->rankings[$name];
    }

    /**
     * Get competition
     *
     * @return \FreeBet\Bundle\CompetitionBundle\Document\Competition
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * Process an event
     *
     * @param \FreeBet\Bundle\SoccerBundle\Document\Match $match
     */
    public function processEvent(Match $match)
    {
        if (!$this->competition) {
            $this->competition = $match->getCompetition();
        }

        $leftTeamRanking = $this->getTeam($match->getLeftName());
        $rightTeamRanking = $this->getTeam($match->getRightName());

        $winner = $match->getWinner();
        if ($winner === Match::RIGHT_TEAM_WIN) {
            $this->processWinningMatch($rightTeamRanking, $leftTeamRanking, $match);
        } elseif ($winner === Match::LEFT_TEAM_WIN) {
            $this->processWinningMatch($leftTeamRanking, $rightTeamRanking, $match);
        } elseif ($winner === Match::BOTH_EQUALS) {
            $this->processEqualMatch($leftTeamRanking, $rightTeamRanking, $match);
        }
    }

    /**
     * Process a winning match
     *
     * @param \FreeBet\Bundle\SoccerBundle\Services\TeamRanking $winningTeam
     * @param \FreeBet\Bundle\SoccerBundle\Services\TeamRanking $losingTeam
     * @param \FreeBet\Bundle\SoccerBundle\Document\Match $match
     */
    protected function processWinningMatch(TeamRanking $winningTeam, TeamRanking $losingTeam, Match $match)
    {
        $winningTeam->addPoint(3);

        if ($winningTeam->getName() == $match->getLeftName()) {
            $winningTeam->addGoalScored($match->getLeftTeamRealScore());
            $winningTeam->addGoalTaken($match->getRightTeamRealScore());

            $losingTeam->addGoalScored($match->getRightTeamRealScore());
            $losingTeam->addGoalTaken($match->getLeftTeamRealScore());
        } else {
            $losingTeam->addGoalScored($match->getLeftTeamRealScore());
            $losingTeam->addGoalTaken($match->getRightTeamRealScore());

            $winningTeam->addGoalScored($match->getRightTeamRealScore());
            $winningTeam->addGoalTaken($match->getLeftTeamRealScore());
        }
    }

    /**
     * Process an equal match
     *
     * @param \FreeBet\Bundle\SoccerBundle\Services\TeamRanking $winningTeam
     * @param \FreeBet\Bundle\SoccerBundle\Services\TeamRanking $losingTeam
     * @param \FreeBet\Bundle\SoccerBundle\Document\Match $match
     */
    protected function processEqualMatch(TeamRanking $winningTeam, TeamRanking $losingTeam, Match $match)
    {
        $winningTeam->addPoint(1);
        $winningTeam->addGoalScored($match->getLeftTeamRealScore());
        $winningTeam->addGoalTaken($match->getLeftTeamRealScore());

        $losingTeam->addPoint(1);
        $losingTeam->addGoalScored($match->getLeftTeamRealScore());
        $losingTeam->addGoalTaken($match->getLeftTeamRealScore());
    }

    /**
     * Sort the ranking
     */
    public function sort()
    {
        // TODO : sort according to direct match result
        uasort($this->rankings, function ($team1, $team2) {
            // sort according to point
            if ($team1->getPoint() != $team2->getPoint()) {
                return ($team1->getPoint() < $team2->getPoint()) ? 1 : -1;
            }

            // if point equals, sort according to diff
            if ($team1->getDiff() != $team2->getDiff()) {
                return ($team1->getDiff() < $team2->getDiff()) ? 1 : -1;
            }

            // Else sort by name
            return ($team1->getName() > $team2->getName()) ? 1 : -1;
        });
    }

    /**
     * Create a ranking
     *
     * @param string $name
     *
     * @return \FreeBet\Bundle\SoccerBundle\Services\TeamRanking
     */
    public function createRanking($name)
    {
        return new TeamRanking($name);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        $keys = array_keys($this->rankings);
        return $this->rankings[$keys[$this->position]];
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        $keys = array_keys($this->rankings);
        return $keys[$this->position];
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        $keys = array_keys($this->rankings);
        return isset($keys[$this->position]);
    }
}
