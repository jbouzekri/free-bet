<?php

namespace FreeBet\Bundle\SoccerWorldCupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of GroupController
 *
 * @author jobou
 */
class GroupController extends Controller
{
    /**
     * Display the list of match in a specific group/phase
     *
     * @param array $events
     * @param string $type
     * @param string $name
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function matchListAction($events, $type, $name)
    {
        $events = $this->get('free_bet.soccer.tools')->getOrderedMatch($events, $type, $name);

        return $this->render('FreeBetSoccerWorldCupBundle:Group:matchList.html.twig', array(
            'events' => $events,
            'type' => $type,
            'name' => $name
        ));
    }

    /**
     * Display the ranking in a group
     *
     * @param array $events
     * @param string $group
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resultAction($events, $group)
    {
        $results = $this->get('free_bet.soccer.tools')->getSortedResults($events, $group);

        return $this->render('FreeBetSoccerWorldCupBundle:Group:result.html.twig', array(
            'results' => $results,
            'group' => $group
        ));
    }
}
