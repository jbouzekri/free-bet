<?php

namespace BettingSas\Bundle\GambleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
