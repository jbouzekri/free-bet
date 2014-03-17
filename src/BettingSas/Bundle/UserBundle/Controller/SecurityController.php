<?php

namespace BettingSas\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use BettingSas\Bundle\UserBundle\Form\Type\RegisterType;
use BettingSas\Bundle\UserBundle\Document\User;

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
     * Display register form
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction()
    {
        $form = $this->createForm(new RegisterType(), new User());

        return $this->render('BettingSasUserBundle:Security:register.html.twig', array('form' => $form->createView()));
    }

    /**
     * Manage register form post
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerProcessAction(Request $request)
    {
        $form = $this->createForm(new RegisterType(), new User());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $form->getData();

            // TODO : first registration in a group give manager role
            $user->setProfil('ROLE_USER');

            // Password encoding
            $user->setSalt(md5(time()));
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);

            // Persist
            $dm = $this->get('doctrine_mongodb')->getManager();
            $dm->persist($user);
            $dm->flush();

            return $this->redirect($this->generateUrl('login'));
        }

        return $this->render('BettingSasUserBundle:Security:register.html.twig', array('form' => $form->createView()));
    }
}
