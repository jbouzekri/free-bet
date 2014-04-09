<?php

namespace BettingSas\Bundle\GambleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use BettingSas\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Validator for constraint gamble_unique_type_on_event_accross_bet
 * Defined as a service
 */
class GambleUniqueTypeOnEventAccrossBetValidator extends ConstraintValidator
{
    /**
     * Gamble Repository
     *
     * @var \BettingSas\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface
     */
    protected $gambleRepository;

    /**
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface $gambleRepository
     */
    public function __construct(GambleRepositoryInterface $gambleRepository)
    {
        $this->gambleRepository = $gambleRepository;
    }

    /**
     * Validate the gamble bet collection
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gamble
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    public function validate($gamble, Constraint $constraint)
    {
        $betsCollection = $gamble->getBets();

        if (!$betsCollection instanceof ArrayCollection) {
            throw new InvalidArgumentException(
                'Invalid value type. Doctrine\Common\Collections\ArrayCollection expected'
            );
        }

        $betTypes = array();
        foreach ($betsCollection as $bet) {
            $eventType = $bet->getEvent()->getType();
            if (!isset($betTypes[$eventType])) {
                $betTypes[$eventType] = array();
            }

            $count = $this
                ->gambleRepository
                ->countAllGambleHavingBetsOnEventWithType($gamble->getUser(), $bet->getEvent(), $bet->getType());
            if ($count > 0 || in_array($bet->getType(), $betTypes[$eventType])) {
                $this->context->addViolationAt(
                    '0',
                    $constraint->message,
                    array(
                        '%type%' => $bet->getType()
                    ),
                    $bet
                );
            }

            $betTypes[$eventType] = $bet->getType();
        }
    }
}
