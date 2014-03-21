<?php

namespace BettingSas\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of GambleController
 *
 * @author jobou
 */
class GambleController extends Controller
{
    public function listGambleAction(Request $request)
    {
        $gamblesQb = $this->get('betting_sas.gamble.cart')
            ->getGambleRepository()
            ->getAllGambleForUserQb($this->getUser());

        $pagination = $this->get('knp_paginator')->paginate(
            $gamblesQb,
            $request->query->get('page', 1),
            10
        );

        return $this->render('BettingSasUserBundle:Gamble:list.html.twig', array(
            'pagination' => $pagination,
            'user' => $this->getUser()
        ));
    }
}
