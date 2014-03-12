<?php

namespace BettingSas\Bundle\GambleBundle\Gamble;

use Symfony\Component\Validator\ValidatorInterface;

use BettingSas\Bundle\GambleBundle\Document\Gamble;
use BettingSas\Bundle\GambleBundle\Gamble\GambleChain;

/**
 * Description of GambleValidator
 *
 * @author jobou
 */
class GambleValidator
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\Gamble\GambleChain
     */
    protected $gambleChain;

    /**
     * @var \Symfony\Component\Validator\ValidatorInterface
     */
    protected $sfValidator;

    /**
     * @var \Symfony\Component\Validator\ConstraintViolationList
     */
    protected $errors;

    /**
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\Gamble\GambleChain $gambleChain
     * @param \Symfony\Component\Validator\ValidatorInterface $sfValidator
     */
    public function __construct(GambleChain $gambleChain, ValidatorInterface $sfValidator)
    {
        $this->gambleChain = $gambleChain;
        $this->sfValidator = $sfValidator;
    }

    /**
     * Validate a Gamble entity
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gamble
     *
     * @return boolean
     */
    public function validate(Gamble $gamble)
    {
        // First : use the symfony validator to validate the entity herself
        $this->errors = $this->sfValidator->validate($gamble);

        $this->validateBets($gamble);

        return true;
    }

    /**
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gamble
     */
    protected function validateBets(Gamble $gamble)
    {
        foreach ($gamble->getBets() as $key => $bet) {
            $gambleClass = $this
                ->gambleChain
                ->getGambleByEventTypeAndType($bet->getEvent()->getType(), $bet->getType());

            $isValid = $gambleClass->validate($bet);
            if (!$isValid) {
                $violiationConstraint = new \Symfony\Component\Validator\ConstraintViolation(
                    'Invalid Type and Choice in Bet',
                    'Invalid Type and Choice in Bet',
                    array(),
                    $gamble,
                    'bets.'.$key,
                    array()
                );
                $this->errors->add($violiationConstraint);
            }

        }
    }
    protected function applyGlobalValidators(Gamble $gamble)
    {
        $this->applyValidators($gamble, $this->getGlobalValidators());
    }

    protected function getGlobalValidators()
    {
        return $this->globalValidators;
    }

    protected function applyValidators(Gamble $gamble, $validators)
    {
        foreach ($this->globalValidators as $validator)
        {
            $validator->validate($gamble);
        }
    }
}
