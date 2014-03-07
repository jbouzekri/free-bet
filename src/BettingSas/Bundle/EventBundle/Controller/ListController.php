<?php

namespace BettingSas\Bundle\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of ListController
 *
 * @author jobou
 */
class ListController extends Controller
{
    public function listAction()
    {
        $events = $this->get('betting_sas.event.manager')
            ->getRepository()
            ->findAllOrderedByDate();

        return $this->render('BettingSasEventBundle::list.html.twig', array(
            'events' => $events
        ));
    }
}
