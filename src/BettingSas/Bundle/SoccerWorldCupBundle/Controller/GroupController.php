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
    public function matchListInGroupAction(array $events, $group)
    {
        $events = $this->get('betting_sas.soccer.tools')->getOrderedMatchInGroup($events, $group);

        return $this->render('BettingSasSoccerWorldCupBundle:Group:matchListInGroup.html.twig', array(
            'events' => $events,
            'group' => $group
        ));
    }

    /**
     * Display the list of match in a specific phase
     *
     * @param array $events
     * @param string $phase
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function matchListInPhaseAction(array $events, $phase)
    {
        $events = $this->get('betting_sas.soccer.tools')->getOrderedMatchInPhase($events, $phase);

        return $this->render('BettingSasSoccerWorldCupBundle:Group:matchListInPhase.html.twig', array(
            'events' => $events,
            'phase' => $phase
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
