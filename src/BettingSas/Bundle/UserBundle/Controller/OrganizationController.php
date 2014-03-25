<?php

namespace BettingSas\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BettingSas\Bundle\UserBundle\Form\Type\SelectOrganizationType;

/**
 * Description of OrganizationController
 *
 * @author jobou
 */
class OrganizationController extends Controller
{
    /**
     * List organization with select field
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function selectAction(Request $request)
    {
        $organizationQb = $this->get('doctrine_mongodb.odm.default_document_manager')
            ->getRepository('BettingSas\Bundle\UserBundle\Document\Organization')
            ->findAllFilteredQb($request->query->get('slug', null));

        $pagination = $this->get('knp_paginator')->paginate(
            $organizationQb,
            $request->query->get('page', 1),
            10
        );

        $form = $this->createForm(new SelectOrganizationType(), null, array('choices'=>$pagination->getItems()));

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $user = $this->getUser();
            $user->setOrganization($data['organization']);

            $om = $this->get('doctrine_mongodb.odm.default_document_manager');
            $om->persist($user);
            $om->flush();

            return $this->redirect($this->generateUrl('competition_list'));
        }

        return $this->render('BettingSasUserBundle:Organization:select.html.twig', array(
            'pagination' => $pagination,
            'form' => $form->createView()
        ));
    }
}
