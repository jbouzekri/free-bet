<?php

namespace BettingSas\Bundle\GambleBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Document\Bet;

/**
 * Description of GambleInterface
 *
 * @author jobou
 */
interface GambleInterface
{
    public function getTemplate();

    public function getCartTemplate();

    public function getName();

    public function processBet(Bet $bet);

    public function validate(Bet $bet);
}

