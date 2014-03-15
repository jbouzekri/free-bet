<?php

namespace BettingSas\Bundle\GambleBundle\Manager;

use BettingSas\Bundle\GambleBundle\Document\Gamble;

/**
 * Description of CartPersisterInterface
 *
 * @author jobou
 */
interface CartPersisterInterface
{
    /**
     * Persist a temporary cart
     * @return void
     */
    public function persist(Gamble $cart);

    /**
     * Load a cart from session
     *
     * @param \BettingSas\Bundle\GambleBundle\Manager\GambleCart $cart
     * @return void
     */
    public function load(GambleCart $cart);
}
