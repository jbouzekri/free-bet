<?php

namespace BettingSas\Bundle\GambleBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\ValidatorInterface;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Document\Gamble;
use BettingSas\Bundle\GambleBundle\Document\Bet;

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
     * @var \Symfony\Component\Validator\ValidatorInterface
     */
    protected $validator;

    /**
     * @var \BettingSas\Bundle\GambleBundle\Manager\CartPersisterInterface
     */
    protected $persister;

    /**
     * @var \BettingSas\Bundle\GambleBundle\Document\Gamble
     */
    protected $gamble;

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     */
    public function __construct(ObjectManager $om, ValidatorInterface $validator, CartPersisterInterface $persister)
    {
        $this->om = $om;
        $this->validator = $validator;
        $this->persister = $persister;
        $this->gamble = new Gamble();
    }

    /**
     * Add a gamble
     *
     * @param type $type
     * @param type $choice
     */
    public function addBet(Bet $bet)
    {
        $this->gamble->addBet($bet);
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
     * @return \BettingSas\Bundle\GambleBundle\Document\Gamble
     */
    public function getGamble()
    {
        return $this->gamble;
    }

    /**
     * Set gamble (override)
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Gamble $gambles
     */
    public function setGamble(Gamble $gamble)
    {
        $this->gamble = $gamble;
    }

    /**
     * Check if there are errors
     *
     * @return boolean
     */
    public function hasErrors()
    {
        return count($this->errors) > 0 || count($this->globalErrors) > 0;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return $this->hasErrors();
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
     * Remove bet
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
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
     */
    public function transform()
    {
        $validation = $this->validator->validate($this->getGamble());
        if (count($validation)) {
            throw new \Exception("there is validation error. TODO !!!");
        }

        $this->getManager()->persist($this->getGamble());
        $this->getManager()->flush();

        $this->clear();
    }
}
