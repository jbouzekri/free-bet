<?php

namespace BettingSas\Bundle\GambleBundle\Gamble;

use Symfony\Component\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraint;
use BettingSas\Bundle\GambleBundle\Document\Gamble;

/**
 * Validator for Gamble Entity
 *
 * @author jobou
 */
class GambleValidator implements GambleValidatorInterface
{
    /**
     * @var \Symfony\Component\Validator\ValidatorInterface
     */
    protected $sfValidator;

    /**
     * @var string
     */
    protected $validationGroup;

    /**
     * Constructor
     *
     * @param \Symfony\Component\Validator\ValidatorInterface $sfValidator
     * @param string $validationGroup
     */
    public function __construct(ValidatorInterface $sfValidator, $validationGroup)
    {
        $this->sfValidator = $sfValidator;
        $this->validationGroup = $validationGroup;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(Gamble $gamble)
    {
        return $this->sfValidator->validate($gamble, array(Constraint::DEFAULT_GROUP, $this->validationGroup));
    }
}
