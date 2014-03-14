<?php

namespace BettingSas\Bundle\GambleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\InvalidArgumentException;

use BettingSas\Bundle\GambleBundle\Document\Bet;
use BettingSas\Bundle\GambleBundle\Gamble\GambleChain;

/**
 * Validator for constraint bet_type_choice
 * Defined as a service
 */
class BetTypeChoiceCoupleValidator extends ConstraintValidator
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\Gamble\GambleChain
     */
    protected $gambleChain;

    /**
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\Gamble\GambleChain $gambleChain
     */
    public function __construct(GambleChain $gambleChain)
    {
        $this->gambleChain = $gambleChain;
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
        $gambleClass = $this->gambleChain->getGambleByEventTypeAndType($event->getType(), $bet->getType());
        if (!$gambleClass->validate($bet)) {
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