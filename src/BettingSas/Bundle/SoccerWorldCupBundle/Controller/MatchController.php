<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of MatchController
 *
 * @author jobou
 */
class MatchController extends Controller
{
    /**
     * List all gambles available for the event
     * Load all with slug to provide friendly url
     *
     * @param string $slugCompetition
     * @param string $slugMatch
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function betAction($slugCompetition, $slugMatch)
    {
        // Find the competition
        $competition = $this->get('betting_sas.competition.manager')
            ->getRepository()
            ->findOneBySlug($slugCompetition);

        if (!$competition) {
            return $this->createNotFoundException('Competition '.$slugCompetition.' does not exists');
        }

        // Find the match in the competition
        $match = $this->get('betting_sas.competition.manager')
            ->getEventRepository()
            ->findOneBy(array('slug'=>$slugMatch, 'competition.id'=>$competition->getId()));

        if (!$match) {
            return $this->createNotFoundException('Match '.$slugMatch.' does not exists');
        }

        return $this->render('BettingSasSoccerWorldCupBundle:Match:bet.html.twig', array(
            'match' => $match,
            'competition' => $competition
        ));
    }
}
