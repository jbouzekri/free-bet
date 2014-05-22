<?php

namespace FreeBet\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * FreeBet Competition Bundle
 *
 * @author jobou
 */
class FreeBetUserBundle extends Bundle
{
    /**
     * {@inheritDoc}
     * Define FOSUserBundle as parent in order to override templates
     *
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
