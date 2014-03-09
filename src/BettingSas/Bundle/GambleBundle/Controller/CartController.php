<?php

namespace BettingSas\Bundle\GambleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Document\Bet;
use BettingSas\Bundle\GambleBundle\Form\Type\BetType;

/**
 * Description of CartController
 *
 * @author jobou
 */
class CartController extends Controller
{
    public function addBetAction(Request $request, Event $event)
    {
        $bet = new Bet();
        $bet->setEvent($event);

        $form = $this->createForm(new BetType(), $bet);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $cart = $this->get('betting_sas.gamble.cart');
            $cart->load();
            $cart->addBet($bet);
            $cart->persist();

            return $this->redirect(
                $this->generateUrl(
                    'competition_detail',
                    array(
                        'slug' => $event->getCompetition()->getSlug()
                    )
                )
            );
        }
    }

    public function viewAction()
    {
        $cart = $this->get('betting_sas.gamble.cart');
        $cart->load();

        return $this->render('BettingSasGambleBundle:Cart:view.html.twig', array(
            'cart' => $cart
        ));
    }
}
