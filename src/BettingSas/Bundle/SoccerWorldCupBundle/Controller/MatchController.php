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
     * @var \BettingSas\Bundle\CompetitionBundle\Document\Competition
     */
    protected $competition;

    /**
     * @var \BettingSas\Bundle\SoccerWorldCupBundle\Document\Match
     */
    protected $match;

    /**
     * Helper to load competition and match in action
     *
     * @param string $slugCompetition
     * @param string $slugMatch
     */
    protected function loadCompetitionMatch($slugCompetition, $slugMatch)
    {
        $this->competition = $this->get('betting_sas.competition.manager')
            ->getRepository()
            ->findOneBySlug($slugCompetition);

        $this->match = $this->get('betting_sas.competition.manager')
            ->getEventRepository($this->competition)
            ->findOneBy(array('slug'=>$slugMatch, 'competition.id'=>$this->competition->getId()));

        if (!$this->competition) {
            return $this->createNotFoundException('Competition '.$slugCompetition.' does not exists');
        }

        if (!$this->match) {
            return $this->createNotFoundException('Match '.$slugMatch.' does not exists');
        }
    }

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
        $this->loadCompetitionMatch($slugCompetition, $slugMatch);

        $form = $this->createForm(
            $this->get('betting_sas.soccer.match.form_type.guesser')->getFormType($this->match),
            $this->match
        );

        $form->handleRequest($request);

        if ($form->isValid()) {
            $om = $this->get('betting_sas.competition.manager')->getManager();
            $om->persist($this->match);
            $om->flush();

            return $this->redirect($this->generateUrl("competition_detail", array("slug"=>$this->competition->getSlug())));
        }

        return $this->render('BettingSasSoccerWorldCupBundle:Match:edit.html.twig', array(
            'form' => $form->createView(),
            'match' => $this->match,
            'competition' => $this->competition
        ));
    }

    public function betAction($slugCompetition, $slugMatch)
    {
        $this->loadCompetitionMatch($slugCompetition, $slugMatch);

        return $this->render('BettingSasSoccerWorldCupBundle:Match:bet.html.twig', array(
            'match' => $this->match,
            'competition' => $this->competition
        ));
    }
}
