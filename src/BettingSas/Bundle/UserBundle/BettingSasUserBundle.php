<?php

namespace BettingSas\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * BettingSas Competition Bundle
 *
 * @author jobou
 */
class BettingSasUserBundle extends Bundle
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
