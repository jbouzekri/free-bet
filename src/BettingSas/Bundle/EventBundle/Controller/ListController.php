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
        return new \Symfony\Component\HttpFoundation\Response('test');
    }
}
