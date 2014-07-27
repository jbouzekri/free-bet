<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FreeBet\Bundle\CompetitionBundle\Document\Competition;

/**
 * LeagueController
 *
 * @author jobou
 */
class LeagueController extends Controller
{
    /**
     * Show navigation in a league (switch between day)
     *
     * @param array $matches
     * @param string $day
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function navigationAction($matches, $day)
    {
        $days = array();
        foreach ($matches as $match) {
            if (!in_array($match->getPhase(), $days)) {
                $days[] = $match->getPhase();
            }
        }

        sort($days);

        return $this->render('FreeBetSoccerLeagueBundle::navigation.html.twig', array(
            'days' => $days,
            'currentDay' => $day
        ));
    }

    /**
     * Show results in a day
     *
     * @param array $matches
     * @param string $day
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resultsDayAction($matches, $day)
    {
        $matchesInDay = array();
        foreach ($matches as $match) {
            if ($match->getPhase() == $day) {
                $matchesInDay[] = $match;
            }
        }

        return $this->render('FreeBetSoccerLeagueBundle::resultsDay.html.twig', array(
            'matches' => $matchesInDay,
            'currentDay' => $day
        ));
    }
}
