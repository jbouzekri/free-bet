<?php

namespace BettingSas\Bundle\GambleBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Document\Gamble;

/**
 * Description of GambleValidatorInterface
 *
 * @author jobou
 */
interface GambleValidatorInterface
{
    /**
     * Validate a Gamble entity
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gamble
     *
     * @return \Symfony\Component\Validator\ConstraintViolationList
     */
    public function validate(Gamble $gamble);
}
