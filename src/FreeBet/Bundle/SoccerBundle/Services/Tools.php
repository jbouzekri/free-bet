<?php

namespace FreeBet\Bundle\SoccerBundle\Services;

use FreeBet\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of Tools
 *
 * @author jobou
 */
class Tools
{
    /**
     * Get the team result ordered by score
     * Can be filtered by group
     *
     * @param array  $events list of matches
     * @param string $group  the group name
     *
     * @return array
     */
    public function getSortedResults($events, $group = null)
    {
        $ranking = new RankingCollection();
        foreach ($events as $event) {
            if (!is_null($group) && $event->getGroup() != $group) {
                continue;
            }

            $ranking->processEvent($event);
        }

        $ranking->sort();

        return $ranking;
    }

    /**
     * Get ordered match in a specific group/phase
     *
     * @param array  $events
     * @param string $type
     * @param string $name
     *
     * @return array
     */
    public function getOrderedMatch($events, $type = 'group', $name = 'A')
    {
        $method = 'get'.ucfirst($type);
        $result = array();

        foreach ($events as $event) {
            if ($event->$method() != $name) {
                continue;
            }
            $result[] = $event;
        }

        $result = $this->sortByDate($result);

        return $result;
    }

    /**
     * Sort an array of event by date
     *
     * @param array $result
     *
     * @return array
     */
    protected function sortByDate($result)
    {
        usort($result, function ($event1, $event2) {
            if ($event1->getDate() == $event2->getDate()) {
                return 0;
            }

            return ($event1->getDate() < $event2->getDate()) ? -1 : 1;
        });

        return $result;
    }
}
