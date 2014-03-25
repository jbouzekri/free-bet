<?php

namespace BettingSas\Bundle\GambleBundle\BetType;

use BettingSas\Bundle\GambleBundle\Document\Bet;

/**
 * BetTypeInterface
 * An interface for all the bet types
 *
 * @author jobou
 */
interface BetTypeInterface
{
    /**
     * Get the default template to render the choices of the gamble in the detail page
     *
     * @return string
     */
    public function getTemplate();

    /**
     * Get the default template to render the gamble in the cart
     *
     * @return string
     */
    public function getCartTemplate();

    /**
     * Get the name of the gamble
     * Must match the alias in the service declaration
     *
     * @return string
     */
    public function getName();

    /**
     * Process a bet.
     * return:
     *  false -> Not a winning bet
     *  true -> A winning bet
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Bet $bet
     *
     * @return bool
     */
    public function processBet(Bet $bet);

    /**
     * Validate a bet against the gamble
     * This is not a processing
     * This method checks if the choice in the bet is a valid one in the gamble
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Bet $bet
     *
     * @return bool
     */
    public function validate(Bet $bet);

    /**
     * Return an integer to gauge the difficulty level of the bet
     * 1: minimal
     * >1 : difficult
     *
     * @return integer
     */
    public function getDifficulty();
}
