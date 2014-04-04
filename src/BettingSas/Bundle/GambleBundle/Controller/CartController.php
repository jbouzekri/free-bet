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
    /**
     * Add a bet to the gamble in the cart
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|null
     */
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

    /**
     * Remove a bet from the gamble in the cart
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeBetAction(Request $request, Event $event)
    {
        $cart = $this->get('betting_sas.gamble.cart');
        $cart->load();
        $cart->removeBetByType($event, $request->request->get('bet_type', null));
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

    /**
     * Transform the cart (persist it)
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function transformAction()
    {
        $cart = $this->get('betting_sas.gamble.cart');
        $cart->load();
        $cart->transform($this->getUser());

        return $this->redirect($this->generateUrl('competition_list'));
    }

    /**
     * Controller used to render the cart directly in the template
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction()
    {
        $cart = $this->get('betting_sas.gamble.cart');
        $cart->load();

        return $this->render('BettingSasGambleBundle:Cart:view.html.twig', array(
            'cart' => $cart
        ));
    }
}
