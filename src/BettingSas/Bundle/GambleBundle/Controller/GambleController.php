<?php

namespace BettingSas\Bundle\GambleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Document\Bet;
use BettingSas\Bundle\GambleBundle\Form\Type\BetType;

/**
 * Description of GambleController
 *
 * @author jobou
 */
class GambleController extends Controller
{
    public function lastSubmittedAction()
    {
        return new \Symfony\Component\HttpFoundation\Response('test');
    }
}
