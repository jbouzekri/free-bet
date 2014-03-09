<?php

namespace BettingSas\Bundle\GambleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use BettingSas\Bundle\CompetitionBundle\Document\Competition;

/**
 * Description of CartController
 *
 * @author jobou
 */
class CartController extends Controller
{
    public function addBetAction(Request $request, Competition $competition, $eventId)
    {
        $match = $this->get('betting_sas.competition.manager')
            ->getEventRepository($competition)
            ->find($eventId);

        return new \Symfony\Component\HttpFoundation\Response('test');
    }

    public function viewAction()
    {
        return $this->render('BettingSasGambleBundle:Cart:view.html.twig', array(
            'cart' => $this->get('betting_sas.gamble.cart')
        ));
    }
}
