<?php

namespace BettingSas\Bundle\GambleBundle\Component\Persister;

use BettingSas\Bundle\GambleBundle\Component\Manager\GambleCart;

/**
 * Description of CartPersisterInterface
 *
 * @author jobou
 */
interface CartPersisterInterface
{
    /**
     * Persist a temporary cart
     */
    public function persist(GambleCart $cart);
}
