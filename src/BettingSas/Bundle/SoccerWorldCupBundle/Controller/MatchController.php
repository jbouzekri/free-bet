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
     * Helper to load competition and match in action
     *
     * @param string $slugCompetition
     * @param string $slugMatch
     */
    public function betAction($slugCompetition, $slugMatch)
    {
        $competition = $this->get('betting_sas.competition.manager')
            ->getRepository()
            ->findOneBySlug($slugCompetition);

        $match = $this->get('betting_sas.competition.manager')
            ->getEventRepository()
            ->findOneBy(array('slug'=>$slugMatch, 'competition.id'=>$competition->getId()));

        if (!$competition) {
            return $this->createNotFoundException('Competition '.$slugCompetition.' does not exists');
        }

        if (!$match) {
            return $this->createNotFoundException('Match '.$slugMatch.' does not exists');
        }

        return $this->render('BettingSasSoccerWorldCupBundle:Match:bet.html.twig', array(
            'match' => $match,
            'competition' => $competition
        ));
    }
}
