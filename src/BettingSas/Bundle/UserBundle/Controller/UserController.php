<?php

namespace BettingSas\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Exception\InvalidParameterException;

/**
 * Description of UserController
 *
 * @author jobou
 */
class UserController extends Controller
{
    /**
     * Controller internal method to check security
     *
     * @param mixed $id
     * @return \BettingSas\Bundle\UserBundle\Model\User
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function checkSecurity($id)
    {
        // To remove a user from an organization. You must have at least ROLE_MANAGER
        if (false === $this->get('security.context')->isGranted('ROLE_MANAGER')) {
            throw new AccessDeniedException();
        }

        $user = $this->get('betting_sas.user.repository')->find($id);
        if (!$user) {
            throw $this->createNotFoundException('User not found');
        }

        // You must be in the same organization than the user or an administrator
        if (!$this->getUser()->hasRole('ROLE_ADMIN')
            && (
                !$user->getOrganization()
                || !$this->getUser()->getOrganization()
                || $user->getOrganization()->getId() !== $this->getUser()->getOrganization()->getId()
            )
        ) {
            throw new AccessDeniedException();
        }

        return $user;
    }

    /**
     * Remove a user from the its organization
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function removeFromOrganizationAction($id)
    {
        $user = $this->checkSecurity($id);

        $user->setOrganization(null);

        try {
            $om = $this->get('doctrine_mongodb.odm.default_document_manager');
            $om->persist($user);
            $om->flush();

            $this->get('session')->getFlashBag()->add(
                'organization-success',
                $this->get('translator')->trans('organization.manage.remove_user_success')
            );
        } catch (\Exception $e) {
            error_log($e->getMessage());
            $this->get('session')->getFlashBag()->add(
                'organization-error',
                $this->get('translator')->trans('organization.manage.remove_user_error')
            );
        }

        return $this->redirect($this->generateUrl('user_organization_manage'));
    }

    /**
     * Modify the role of the user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Symfony\Component\Security\Core\Exception\AccessDeniedException
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Symfony\Component\Routing\Exception\InvalidParameterException
     */
    public function changeRoleAction($id, $role = 'ROLE_USER')
    {
        $user = $this->checkSecurity($id);

        // Security against admin role assignation
        if (!in_array($role, array('ROLE_USER', 'ROLE_MANAGER')) && !$this->getUser()->hasRole('ROLE_ADMIN')) {
            throw new AccessDeniedException('You cannot set this role to the user');
        }

        $user->setRoles(array($role));
        $errors = $this->get('validator')->validate($user);
        if (count($errors) > 0) {
            throw new InvalidParameterException('The role '.$role.' is not a valid one');
        }

        $om = $this->get('doctrine_mongodb.odm.default_document_manager');
        $om->persist($user);
        $om->flush();

        return $this->redirect($this->generateUrl('user_organization_manage'));
    }
}
