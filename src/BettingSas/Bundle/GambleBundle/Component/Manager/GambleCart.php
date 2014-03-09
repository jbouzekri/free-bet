<?php

namespace BettingSas\Bundle\GambleBundle\Component\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Component\Persister\CartPersisterInterface;

/**
 * Description of GambleCart
 *
 * @author jobou
 */
class GambleCart
{
    /**
     * @var \Doctrine\Common\Persistence\ManagerRegistry
     */
    protected $manager;

    /**
     * @var \BettingSas\Bundle\GambleBundle\Component\Persister\CartPersisterInterface
     */
    protected $persister;

    /**
     * @var array
     */
    protected $gambles = array();

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ManagerRegistry $manager
     */
    public function __construct(ManagerRegistry $manager, CartPersisterInterface $persister)
    {
        $this->manager = $manager;
        $this->persister = $persister;
    }

    /**
     * Add a gamble
     *
     * @param type $type
     * @param type $choice
     */
    public function addGamble(Event $event, $type, $choice)
    {
        $this->gambles[$event->getCompetition()->getSlug()][$event->getId()][$type] = $choice;
    }

    /**
     * Get Manager
     * @return \Doctrine\Common\Persistence\ManagerRegistry
     */
    protected function getManager()
    {
        return $this->manager->getManager();
    }

    /**
     * Get Gamble in cart
     *
     * @return array
     */
    public function getGambles()
    {
        return $this->gambles;
    }

    /**
     * Set gambles
     *
     * @param array $gambles
     */
    public function setGambles(array $gambles)
    {
        $this->gambles = $gambles;
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
        if (count($this->gambles) == 0) {
            return;
        }

        $this->getManager()
            ->getRepository('BettingSasGambleBundle:Bet')
            ->removeBetOnEvent($this->event);

        foreach ($this->gambles as $type => $choice) {
            $bet = new \BettingSas\Bundle\GambleBundle\Document\Bet();
            $bet->setType($type);
            $bet->setChoice($choice);
            $bet->setEvent($this->event);

            $this->getManager()->persist($bet);
        }

        $this->getManager()->flush();
    }
}
