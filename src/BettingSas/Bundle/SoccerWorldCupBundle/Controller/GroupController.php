<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of GroupController
 *
 * @author jobou
 */
class GroupController extends Controller
{
    /**
     * Display the list of match in a specific group
     *
     * @param array $events
     * @param string $group
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function matchListAction(array $events, $group)
    {
        $events = $this->get('betting_sas.soccer.tools')->getOrderedMatchInGroup($events, $group);

        return $this->render('BettingSasSoccerWorldCupBundle:Group:matchList.html.twig', array(
            'events' => $events,
            'group' => $group
        ));
    }

    /**
     * Display the classement in a group
     *
     * @param array $events
     * @param string $group
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resultAction(array $events, $group)
    {
        $results = $this->get('betting_sas.soccer.tools')->getResultInGroup($events, $group);

        return $this->render('BettingSasSoccerWorldCupBundle:Group:result.html.twig', array(
            'results' => $results,
            'group' => $group
        ));
    }
}
