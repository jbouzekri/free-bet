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

            if (!isset($result[$event->getLeftName()])) {
                $result[$event->getLeftName()] = array('point'=>0,'diff'=>0);
            }
            if (!isset($result[$event->getRightName()])) {
                $result[$event->getRightName()] = array('point'=>0,'diff'=>0);
            }

            $isLeftWin = $event->isLeftTeamWin();
            if ($isLeftWin === true) {
                $result[$event->getLeftName()]['point'] += 3;
                $result[$event->getLeftName()]['diff'] += $event->getLeftRealScore() - $event->getRightRealScore();
                $result[$event->getRightName()]['diff'] += $event->getRightRealScore() - $event->getLeftRealScore();
            } elseif ($isLeftWin === false) {
                $result[$event->getRightName()]['point'] += 3;
                $result[$event->getRightName()]['diff'] += $event->getRightRealScore() - $event->getLeftRealScore();
                $result[$event->getLeftName()]['diff'] += $event->getLeftRealScore() - $event->getRightRealScore();
            } elseif ($isLeftWin === 0) {
                $result[$event->getRightName()]['point'] += 1;
                $result[$event->getLeftName()]['point'] += 1;
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
