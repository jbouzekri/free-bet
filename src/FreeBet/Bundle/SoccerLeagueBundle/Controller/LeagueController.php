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
    public function navigationAction(Competition $competition, array $matches, $day)
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
}
