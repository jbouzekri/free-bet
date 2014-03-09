<?php

namespace BettingSas\Bundle\GambleBundle\Component\Persister;

use BettingSas\Bundle\GambleBundle\Document\Gamble;
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
    public function persist(Gamble $cart);

    /**
     * Load a cart from session
     *
     * @param \BettingSas\Bundle\GambleBundle\Component\Manager\GambleCart $cart
     */
    public function load(GambleCart $cart);
}
