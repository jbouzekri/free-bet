<?php

namespace FreeBet\Bundle\StatisticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of DashboardController
 *
 * @author jobou
 */
class DashboardController extends Controller
{
    /**
     * Display the dashboard
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayAction()
    {
        $stats = $this->get('free_bet.gamble.repository')->getGambleProcessedStats($this->getUser());
        $points = $this->get('free_bet.gamble.repository')->getGambleResultStats($this->getUser());

        return $this->render('FreeBetStatisticBundle:Dashboard:display.html.twig', array(
            'stats' => $stats,
            'point' => $points['total_point'],
            'count' => $points['total_gamble']
        ));
    }
}
