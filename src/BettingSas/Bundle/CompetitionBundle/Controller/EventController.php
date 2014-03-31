<?php

namespace BettingSas\Bundle\CompetitionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of EventController
 *
 * @author jobou
 */
class EventController extends Controller
{
    /**
     * Edit a match to set results
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Event $event)
    {
        $form = $this->createForm(
            $event->getFormType(),
            $event
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $om = $this->get('doctrine_mongodb.odm.default_document_manager');
            $om->persist($event);
            $om->flush();

            return $this->redirect(
                $this->generateUrl(
                    "competition_detail",
                    array(
                        "slug" => $event->getCompetition()->getSlug()
                    )
                )
            );
        }

        return $this->render('BettingSasCompetitionBundle:Event:edit.html.twig', array(
            'form' => $form->createView(),
            'match' => $event
        ));
    }
}
