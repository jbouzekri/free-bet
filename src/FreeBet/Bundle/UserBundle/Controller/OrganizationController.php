<?php

namespace FreeBet\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FreeBet\Bundle\UserBundle\Form\Type\SelectOrganizationType;
use FreeBet\Bundle\UserBundle\Form\Type\OrganizationType;
use FreeBet\Bundle\UserBundle\Document\Organization;

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
        $slug = $request->query->get('slug', null);

        $organizationQb = $this
            ->get('free_bet.organization.repository')
            ->findAllFilteredQb($slug);

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

            $this->get('session')->getFlashBag()->add(
                'user-success',
                $this->get('translator')->trans('organization.choose.change_group_success')
            );

            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }

        return $this->render('FreeBetUserBundle:Organization:select.html.twig', array(
            'pagination' => $pagination,
            'form' => $form->createView(),
            'slug' =>$slug
        ));
    }

    /**
     * View the detail of an organization
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function manageAction(Request $request)
    {
        if (false === $this->get('security.context')->isGranted('ROLE_MANAGER')) {
            throw new AccessDeniedException();
        }

        $group = $this->getUser()->getOrganization();
        if (!$group) {
            throw $this->createNotFoundException('You are not part of any group');
        }

        $userQb = $this
            ->get('free_bet.user.repository')
            ->findAllInOrganizationQb($group);

        $pagination = $this->get('knp_paginator')->paginate(
            $userQb,
            $request->query->get('page', 1),
            10
        );

        return $this->render('FreeBetUserBundle:Organization:manage.html.twig', array(
            'pagination' => $pagination,
            'organization' => $group
        ));
    }

    /**
     * Create a new organization
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $organization = new Organization();
        $form = $this->createForm(new OrganizationType(), $organization);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $user = $this->getUser();
            $user->addRole('ROLE_MANAGER');
            $user->setOrganization($organization);

            $om = $this->get('doctrine_mongodb.odm.default_document_manager');
            $om->persist($organization);
            $om->persist($user);
            $om->flush();

            // Force reload of user in security context
            $this->get('security.context')->getToken()->setAuthenticated(false);

            $this->get('session')->getFlashBag()->add(
                'user-success',
                $this->get('translator')->trans('organization.new.success')
            );

            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }

        return $this->render('FreeBetUserBundle:Organization:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
