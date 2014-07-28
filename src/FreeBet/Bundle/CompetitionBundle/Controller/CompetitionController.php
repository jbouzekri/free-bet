<?php

namespace FreeBet\Bundle\CompetitionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FreeBet\Bundle\CompetitionBundle\Document\Competition;

/**
 * Description of ListController
 *
 * @author jobou
 */
class CompetitionController extends Controller
{
    /**
     * Left column menu
     *
     * @param array $routeParam
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function menuAction($routeParam = array())
    {
        $competitions = $this->get('free_bet.competition.repository')->findCurrentOrderedByName();

        return $this->render('FreeBetCompetitionBundle:Competition:menu.html.twig', array(
            'competitions' => $competitions,
            'main_request_route_param' => $routeParam
        ));
    }

    /**
     * View competition detail
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Competition $competition
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(Competition $competition)
    {
        // Load all events of the competition
        // We suppose that the number of event is always small so it does not cost much to manage all at once
        $events = $this->get('free_bet.event.repository')->findAllOrderedEvent($competition);

        return $this->competitionRender($competition, $events, 'view.html.twig');
    }

    /**
     * List ended competitions
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function archivesAction()
    {
        $competitions = $this->get('free_bet.competition.repository')->findEndedOrderedByEndDate();

        return $this->render('FreeBetCompetitionBundle:Competition:archives.html.twig', array(
            'competitions' => $competitions
        ));
    }

    /**
     * Render a specific template according to the type of the competition
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Competition $competition
     * @param mixed $events
     * @param string $template
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function competitionRender(Competition $competition, $events, $template)
    {
        // TODO : remove hack to change view template according to competition type.
        // TODO : implements a template guesser service
        $type = \Doctrine\Common\Util\Inflector::classify($competition->getType());

        return $this->render('FreeBet'.$type.'Bundle::'.$template, array(
            'competition' => $competition,
            'events' => $events
        ));
    }
}
