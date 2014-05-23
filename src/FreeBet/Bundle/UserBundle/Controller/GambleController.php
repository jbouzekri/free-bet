<?php

namespace FreeBet\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FreeBet\Bundle\GambleBundle\Document\Gamble;

/**
 * Description of GambleController
 *
 * @author jobou
 */
class GambleController extends Controller
{
    /**
     * Paginated list of the authenticated user's gamble
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $gamblesQb = $this->get('free_bet.gamble.repository')->getAllGambleForUserQb($this->getUser());

        $pagination = $this->get('knp_paginator')->paginate(
            $gamblesQb,
            $request->query->get('page', 1),
            10
        );

        return $this->render('FreeBetUserBundle:Gamble:list.html.twig', array(
            'pagination' => $pagination,
            'user' => $this->getUser()
        ));
    }

    /**
     * View a specific gamble
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Gamble $gamble)
    {
        if ($gamble->getUser()->getId() != $this->getUser()->getId()) {
            throw new AccessDeniedException('This is not your gamble !');
        }

        return $this->render('FreeBetUserBundle:Gamble:view.html.twig', array(
            'gamble'    => $gamble,
            'bet_types' => $this->get('free_bet.bet_type_chain')
        ));
    }
}
