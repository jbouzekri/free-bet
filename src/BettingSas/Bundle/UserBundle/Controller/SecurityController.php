<?php

namespace BettingSas\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Description of SecurityController
 *
 * @author jobou
 */
class SecurityController extends Controller
{
    /**
     * Display login form
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'BettingSasUserBundle:Security:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    /**
     * Display the classement in a group
     *
     * @param array $events
     * @param string $group
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resultAction(array $events, $group)
    {
        $results = $this->get('betting_sas.soccer.tools')->getResultInGroup($events, $group);

        return $this->render('BettingSasSoccerWorldCupBundle:Group:result.html.twig', array(
            'results' => $results,
            'group' => $group
        ));
    }
}
