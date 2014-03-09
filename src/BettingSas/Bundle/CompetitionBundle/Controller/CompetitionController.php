<?php

namespace BettingSas\Bundle\CompetitionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BettingSas\Bundle\CompetitionBundle\Document\Competition;

/**
 * Description of ListController
 *
 * @author jobou
 */
class CompetitionController extends Controller
{
    public function listAction()
    {
        $competitions = $this->get('betting_sas.competition.manager')
            ->getRepository()
            ->findAllOrderedByDate();

        return $this->render('BettingSasCompetitionBundle:Competition:list.html.twig', array(
            'competitions' => $competitions
        ));
    }

    public function viewAction(Competition $competition)
    {
        $type = \Doctrine\Common\Util\Inflector::classify($competition->getType());

        $events = $this->get('betting_sas.competition.manager')
            ->getEventRepository()
            ->findBy(array('competition.id'=>$competition->getId()));

        return $this->render('BettingSas'.$type.'Bundle::view.html.twig', array(
            'competition' => $competition,
            'events' => $events
        ));
    }
}
