<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of MatchController
 *
 * @author jobou
 */
class MatchController extends Controller
{
    /**
     * Edit a match to set results
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $slugCompetition
     * @param string $slugMatch
     *
     * @return Response
     */
    public function editAction(Request $request, $slugCompetition, $slugMatch)
    {
        $competition = $this->get('betting_sas.competition.manager')
            ->getRepository()
            ->findOneBySlug($slugCompetition);

        $match = $this->get('betting_sas.competition.manager')
            ->getEventRepository($competition)
            ->findOneBy(array('slug'=>$slugMatch, 'competition.id'=>$competition->getId()));

        $form = $this->createForm(
            $this->get('betting_sas.soccer.match.form_type.guesser')->getFormType($match),
            $match
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $om = $this->get('betting_sas.competition.manager')->getManager();
            $om->persist($match);
            $om->flush();

            return $this->redirect($this->generateUrl("competition_detail", array("slug"=>$competition->getSlug())));
        }

        return $this->render('BettingSasSoccerWorldCupBundle:Match:edit.html.twig', array(
            'form' => $form->createView(),
            'match' => $match,
            'competition' => $competition
        ));
    }
}
