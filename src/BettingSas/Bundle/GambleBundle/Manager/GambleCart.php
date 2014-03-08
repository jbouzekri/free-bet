<?php

namespace BettingSas\Bundle\GambleBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of GambleCart
 *
 * @author jobou
 */
class GambleCart
{
    /**
     * @var \BettingSas\Bundle\CompetitionBundle\Document\Event
     */
    protected $event;

    /**
     * @var \Doctrine\Common\Persistence\ManagerRegistry
     */
    protected $manager;

    /**
     * @var array
     */
    protected $gambles = array();

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ManagerRegistry $manager
     */
    public function __construct(ManagerRegistry $manager)
    {
        $this->manager = $manager;;
    }

    /**
     * Set the event
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Add a gamble
     *
     * @param type $type
     * @param type $choice
     */
    public function addGamble($type, $choice)
    {
        $this->gambles[$type] = $choice;
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
