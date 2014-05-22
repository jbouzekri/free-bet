<?php

namespace FreeBet\Bundle\StatisticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of DashboardController
 *
 * @author jobou
 */
class DashboardController extends Controller
{
    /**
     * Display the dashboard
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function displayAction()
    {
        $widgets = $this->getUser()->getWidgets();
        if (count($widgets) == 0) {
            $widgets = $this->container->getParameter('free_bet.default_widgets');
        }

        return $this->render('FreeBetStatisticBundle:Dashboard:display.html.twig', array(
            'widgets' => $widgets
        ));
    }
}
