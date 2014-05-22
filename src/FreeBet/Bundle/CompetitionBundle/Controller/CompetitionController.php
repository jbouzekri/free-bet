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
     * List all competition
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $competitions = $this->get('free_bet.competition.repository')->findAllOrderedByDate();

        return $this->render('FreeBetCompetitionBundle:Competition:list.html.twig', array(
            'competitions' => $competitions
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
        // TODO : remove hack to change view template according to competition type.
        // TODO : implements a template guesser service
        $type = \Doctrine\Common\Util\Inflector::classify($competition->getType());

        // Load all events of the competition
        // We suppose that the number of event is always small so it does not cost much to manage all at once
        $events = $this->get('free_bet.event.repository')->findBy(array('competition.id'=>$competition->getId()));

        return $this->render('FreeBet'.$type.'Bundle::view.html.twig', array(
            'competition' => $competition,
            'events' => $events
        ));
    }

    /**
     * View the next events in list format
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Competition $competition
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listNextEventAction(Competition $competition)
    {
        // TODO : remove hack to change view template according to competition type.
        // TODO : implements a template guesser service
        $type = \Doctrine\Common\Util\Inflector::classify($competition->getType());

        $events = $this->get('free_bet.event.repository')->findNextEvents();

        return $this->render('FreeBet'.$type.'Bundle::nextEvents.html.twig', array(
            'competition' => $competition,
            'events' => $events
        ));
    }
}
