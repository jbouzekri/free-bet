<?php

namespace FreeBet\Bundle\GambleBundle\Gamble;

use FreeBet\Bundle\GambleBundle\Document\Gamble;

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
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     *
     * @return \Symfony\Component\Validator\ConstraintViolationList
     */
    public function validate(Gamble $gamble);
}
