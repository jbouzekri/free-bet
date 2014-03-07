<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of ListController
 *
 * @author jobou
 */
class WorldCupController extends Controller
{
    public function listAction()
    {
        $competitions = $this->get('betting_sas.competition.manager')
            ->getRepository()
            ->findAllOrderedByDate();

        return $this->render('BettingSasCompetitionBundle::list.html.twig', array(
            'competitions' => $competitions
        ));
    }

    public function viewAction(Competition $competitions)
    {
        return $this->render('BettingSasCompetitionBundle::view.html.twig', array(
            'competition' => $competitions
        ));
    }
}
