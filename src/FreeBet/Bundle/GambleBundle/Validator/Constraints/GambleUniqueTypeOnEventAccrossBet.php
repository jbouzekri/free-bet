<?php

namespace FreeBet\Bundle\GambleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * GambleUniqueTypeOnEventAccrossBet
 * Validator Constraints : check if the type of gamble was already used in another gamble on the same event
 *
 * @Annotation
 */
class GambleUniqueTypeOnEventAccrossBet extends Constraint
{
    /**
     * Default validator message
     *
     * @var string
     */
    public $message = 'You already used the gamble %type% in another bet on the same event.';

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
        return 'gamble_unique_type_on_event_accross_bet';
    }
}
