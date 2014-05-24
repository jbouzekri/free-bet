<?php

namespace FreeBet\Bundle\GambleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FreeBet\Bundle\GambleBundle\Document\Gamble;

/**
 * Description of GambleController
 *
 * @author jobou
 */
class GambleController extends Controller
{
    /**
     * Remove a gamble
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeAction(Gamble $gamble)
    {
        if (!$gamble->canDelete($this->getUser())) {
            throw new AccessDeniedException('You cannot remove this gamble');
        }

        $om = $this->get('doctrine_mongodb.odm.default_document_manager');
        $om->remove($gamble);
        $om->flush();

        $this->get('session')->getFlashBag()->add(
            'gamble-success',
            $this->get('translator')->trans('gamble.notice.remove')
        );

        return new RedirectResponse($this->generateUrl('user_account_gambles_list'));
    }
}
