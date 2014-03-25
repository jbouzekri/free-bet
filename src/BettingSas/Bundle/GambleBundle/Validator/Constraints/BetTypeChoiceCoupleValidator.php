<?php

namespace BettingSas\Bundle\GambleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use BettingSas\Bundle\GambleBundle\Document\Bet;
use BettingSas\Bundle\GambleBundle\BetType\BetTypeChain;

/**
 * Validator for constraint bet_type_choice
 * Defined as a service
 */
class BetTypeChoiceCoupleValidator extends ConstraintValidator
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain
     */
    protected $betTypeChain;

    /**
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain $betTypeChain
     */
    public function __construct(BetTypeChain $betTypeChain)
    {
        $this->betTypeChain = $betTypeChain;
    }

    /**
     * Validate a bet using its associated gamble
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Bet $bet
     * @param \Symfony\Component\Validator\Constraint $constraint
     *
     * @throws \Symfony\Component\Validator\Exception\InvalidArgumentException
     */
    public function validate($bet, Constraint $constraint)
    {
        if (!$bet instanceof Bet) {
            throw new InvalidArgumentException(
                'Invalid value type. BettingSas\Bundle\GambleBundle\Document\Bet expected'
            );
        }

        $event = $bet->getEvent();
        $betTypeEntity = $this->betTypeChain->findByEventTypeAndType($event->getType(), $bet->getType());
        if (!$betTypeEntity->validate($bet)) {
            $this->context->addViolation(
                $constraint->message,
                array(
                    '%type%' => $bet->getType(),
                    '%choice%' => $bet->getChoice()
                ),
                $bet
            );
        }
    }
}
