<?php

namespace FreeBet\Bundle\GambleBundle\Manager;

use FreeBet\Bundle\GambleBundle\Document\Gamble;

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
     * @param \FreeBet\Bundle\GambleBundle\Manager\GambleCart $cart
     * @return void
     */
    public function load(GambleCart $cart);
}
