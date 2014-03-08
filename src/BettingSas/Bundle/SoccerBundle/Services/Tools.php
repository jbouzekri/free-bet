<?php

namespace BettingSas\Bundle\SoccerBundle\Services;

/**
 * Description of Tools
 *
 * @author jobou
 */
class Tools
{
    /**
     * Get the team result in a group ordered by score
     *
     * @param array $collections list of matches
     * @param string $group the group name
     */
    public function getResultInGroup(array $events, $group)
    {
        $result = array();

        foreach ($events as $event) {
            if ($event->getGroup() != $group) {
                continue;
            }

            if (!isset($result[$event->getLeftTeamName()])) {
                $result[$event->getLeftTeamName()] = array('point'=>0,'diff'=>0);
            }
            if (!isset($result[$event->getRightTeamName()])) {
                $result[$event->getRightTeamName()] = array('point'=>0,'diff'=>0);
            }

            $isLeftTeamWin = $event->isLeftTeamWin();
            if ($isLeftTeamWin === true) {
                $result[$event->getLeftTeamName()]['point'] += 3;
                $result[$event->getLeftTeamName()]['diff'] += $event->getLeftTeamRealScore() - $event->getRightTeamRealScore();
                $result[$event->getRightTeamName()]['diff'] += $event->getRightTeamRealScore() - $event->getLeftTeamRealScore();
            } elseif ($isLeftTeamWin === false) {
                $result[$event->getRightTeamName()]['point'] += 3;
                $result[$event->getRightTeamName()]['diff'] += $event->getRightTeamRealScore() - $event->getLeftTeamRealScore();
                $result[$event->getLeftTeamName()]['diff'] += $event->getLeftTeamRealScore() - $event->getRightTeamRealScore();
            } elseif ($isLeftTeamWin === 0) {
                $result[$event->getRightTeamName()]['point'] += 1;
                $result[$event->getLeftTeamName()]['point'] += 1;
            }
        }

        // TODO : sort according to point, diff and direct match
        uasort($result, function ($team1, $team2) {
            if ($team1['point'] == $team2['point']) {
                return 0;
            }
            return ($team1['point'] < $team2['point']) ? -1 : 1;
        });

        return $result;
    }

    /**
     * Get ordered match in a specific group
     *
     * @param array $events
     * @param string $group
     *
     * @return array
     */
    public function getOrderedMatchInGroup(array $events, $group)
    {
        $result = array();

        foreach ($events as $event) {
            if ($event->getGroup() != $group) {
                continue;
            }
            $result[] = $event;
        }

        usort($result, function ($event1, $event2) {
            if ($event1->getDate() == $event2->getDate()) {
                return 0;
            }
            return ($event1->getDate() < $event2->getDate()) ? -1 : 1;
        });

        return $result;
    }
}
