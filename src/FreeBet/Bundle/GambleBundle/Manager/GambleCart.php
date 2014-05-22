<?php

namespace FreeBet\Bundle\GambleBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use FreeBet\Bundle\CompetitionBundle\Document\Event;
use FreeBet\Bundle\GambleBundle\Document\Gamble;
use FreeBet\Bundle\GambleBundle\Document\Bet;
use FreeBet\Bundle\GambleBundle\Gamble\GambleValidatorInterface;
use FreeBet\Bundle\UserBundle\Document\User;

/**
 * Description of GambleCart
 *
 * @author jobou
 */
class GambleCart
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $om;

    /**
     * @var \FreeBet\Bundle\GambleBundle\Gamble\GambleValidatorInterface
     */
    protected $validator;

    /**
     * @var \FreeBet\Bundle\GambleBundle\Manager\CartPersisterInterface
     */
    protected $persister;

    /**
     * @var \FreeBet\Bundle\GambleBundle\Document\Gamble
     */
    protected $gamble;

    /**
     * @var array|\Symfony\Component\Validator\ConstraintViolationList
     */
    protected $errors = array();

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     */
    public function __construct(
        ObjectManager $om,
        GambleValidatorInterface $validator,
        CartPersisterInterface $persister
    ) {
        $this->om = $om;
        $this->validator = $validator;
        $this->persister = $persister;
        $this->gamble = new Gamble();
    }

    /**
     * Add a gamble
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Bet $bet
     * @return self
     */
    public function addBet(Bet $bet)
    {
        $this->gamble->addBet($bet);

        return $this;
    }

    /**
     * Get Manager
     *
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getManager()
    {
        return $this->om;
    }

    /**
     * Get Gamble in cart
     *
     * @return \FreeBet\Bundle\GambleBundle\Document\Gamble
     */
    public function getGamble()
    {
        return $this->gamble;
    }

    /**
     * Set gamble (override)
     *
     * @param \FreeBet\Bundle\GambleBundle\Document\Gamble $gamble
     */
    public function setGamble(Gamble $gamble)
    {
        $this->gamble = $gamble;
    }

    /**
     * Check if gamble is valid
     * WARNING : call validate() before
     *
     * @return boolean
     */
    public function isValid()
    {
        return count($this->errors) == 0;
    }

    /**
     * Get error
     *
     * @return array|\Symfony\Component\Validator\ConstraintViolationList
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Get errors on cart and/or gamble entity
     *
     * @return array
     */
    public function getGlobalErrors()
    {
        $globalErrors = array();
        foreach ($this->getErrors() as $error) {
            if (strpos($error->getPropertyPath(), 'bets.') === false) {
                $globalErrors[] = $error;
            }
        }
        return $globalErrors;
    }

    public function getBetErrors(Bet $bet)
    {
        $betErrors = array();
        foreach ($this->getErrors() as $error) {
            if ($error->getInvalidValue() == $bet) {
                $betErrors[] = $error;
            }
        }
        return $betErrors;
    }

    /**
     * Persit Gamble
     *
     * @return null
     */
    public function persist()
    {
        $this->persister->persist($this->getGamble());
    }

    /**
     * Load from source
     */
    public function load()
    {
        $this->persister->load($this);
    }

    /**
     * Validate the gamble loaded in the cart
     *
     * @return \Symfony\Component\Validator\ConstraintViolationList
     */
    public function validate()
    {
        $this->errors = $this->validator->validate($this->getGamble());

        return $this->errors;
    }

    /**
     * Remove bet
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     * @param string $type
     */
    public function removeBetByType(Event $event, $type = null)
    {
        foreach ($this->getGamble()->getBets() as $bet) {
            if ($bet->getType() == $type) {
                $this->getGamble()->removeBet($bet);
            }
        }
    }

    /**
     * Clear the current gamble
     */
    public function clear()
    {
        $this->gamble = new Gamble();
        $this->persist();
    }

    /**
     * Transform the gamble
     * Save it to db
     *
     * @param \FreeBet\Bundle\UserBundle\Document\User $user
     *
     * @return boolean
     */
    public function transform(User $user)
    {
        $this->getGamble()->setUser($user);
        if (null !== $user->getOrganization()) {
            $this->getGamble()->setOrganization($user->getOrganization());
        }

        $this->validate();
        if ($this->isValid()) {
            $this->getManager()->persist($this->getGamble());
            $this->getManager()->flush();

            $this->clear();

            return true;
        }

        return false;
    }
}
