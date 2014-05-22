<?php

namespace FreeBet\Bundle\UIBundle\Menu;

use Symfony\Component\Security\Core\SecurityContextInterface;
use Maestro\Bundle\NavigationBundle\Event\ConfigureMenuEvent;

/**
 * Description of ConfigurationListener
 *
 * @author jobou
 */
class ConfigurationListener
{
    /**
     * Security context
     *
     * @var \Symfony\Component\Security\Core\SecurityContextInterface
     */
    protected $securityContext;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Security\Core\SecurityContextInterface $securityContext
     */
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * Executed on maestro.navigation.menu_configure event
     *
     * @param \Maestro\Bundle\NavigationBundle\Event\ConfigureMenuEvent $eventMenu
     */
    public function configureMenu(ConfigureMenuEvent $eventMenu)
    {
        $menu = $eventMenu->getMenu();

        if ($menu->getName() != 'main') {
            return;
        }

        if (!$this->securityContext->isGranted('ROLE_MANAGER')) {
            $menu->removeChild('organization_item');
        }
    }
}
