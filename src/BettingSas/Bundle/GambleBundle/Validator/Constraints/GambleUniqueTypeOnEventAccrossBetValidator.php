<?php

namespace BettingSas\Bundle\GambleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Validator for constraint gamble_unique_type_on_event_accross_bet
 * Defined as a service
 */
class GambleUniqueTypeOnEventAccrossBetValidator extends ConstraintValidator
{
    /**
     * Object Manager
     *
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $om;

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Validate the gamble bet collection
     */
    public function validate($betsCollection, Constraint $constraint)
    {
        if (!$betsCollection instanceof ArrayCollection) {
            throw new InvalidArgumentException(
                'Invalid value type. Doctrine\Common\Collections\ArrayCollection expected'
            );
        }

        foreach ($betsCollection as $bet) {
            $count = $this->om
                ->getRepository('BettingSasGambleBundle:Gamble')
                ->countAllGambleHavingBetsOnEventWithType($bet->getEvent(), $bet->getType());
            if ($count > 0) {
                $this->context->addViolationAt(
                    '0',
                    $constraint->message,
                    array(
                        '%type%' => $bet->getType()
                    ),
                    $bet
                );
            }
        }
    }
}
