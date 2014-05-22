<?php

namespace FreeBet\Bundle\GambleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use FreeBet\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface;
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
     * @var \FreeBet\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface
     */
    protected $gambleRepository;

    /**
     * Constructor
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Repository\GambleRepositoryInterface $gambleRepository
     */
    public function __construct(GambleRepositoryInterface $gambleRepository)
    {
        $this->gambleRepository = $gambleRepository;
    }

    /**
     * Validate the gamble bet collection
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
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
        foreach ($betsCollection as $position => $bet) {
            $eventId = $bet->getEvent()->getId();
            if (!isset($betTypes[$eventId])) {
                $betTypes[$eventId] = array();
            }

            $count = $this
                ->gambleRepository
                ->countAllGambleHavingBetsOnEventWithType($gamble->getUser(), $bet->getEvent(), $bet->getType());
            if ($count > 0 || in_array($bet->getType(), $betTypes[$eventId])) {
                $this->context->addViolationAt(
                    'bets.'.$position,
                    $constraint->message,
                    array(
                        '%type%' => $bet->getType()
                    ),
                    $bet
                );
            }

            $betTypes[$eventId][] = $bet->getType();
        }
    }
}
