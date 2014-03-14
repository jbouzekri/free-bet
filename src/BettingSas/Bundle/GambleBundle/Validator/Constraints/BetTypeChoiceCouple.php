<?php

namespace BettingSas\Bundle\GambleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * BetTypeChoiceCouple
 * Validator Constraints : check if the couple type/choice in a bet is allowed
 *
 * @Annotation
 */
class BetTypeChoiceCouple extends Constraint
{
    /**
     * Default validator message
     *
     * @var string
     */
    public $message = 'The type "%type%" does not allow %choice% value.';

    /**
     * {@inhericDoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    /**
     * {@inheritDoc}
     */
    public function validatedBy()
    {
        return 'bet_type_choice';
    }
}