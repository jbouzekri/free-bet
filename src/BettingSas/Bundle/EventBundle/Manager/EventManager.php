<?php

namespace BettingSas\Bundle\EventBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Description of EventManager
 *
 * @author jobou
 */
class EventManager
{
    /**
     *
     * @var \Doctrine\Common\Persistence\ManagerRegistry
     */
    protected $manager;

    /**
     *
     * @param \Doctrine\Common\Persistence\ManagerRegistry $manager
     */
    public function __construct(ManagerRegistry $manager)
    {
        $this->manager = $manager;
    }

    /**
     * get repository for event
     * @return \BettingSas\Bundle\EventBundle\Document\Repository\EventRepository
     */
    public function getRepository()
    {
        return $this->manager->getManager()->getRepository('BettingSasEventBundle:Event');
    }
}
