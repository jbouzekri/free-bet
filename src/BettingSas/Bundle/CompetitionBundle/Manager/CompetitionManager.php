<?php

namespace BettingSas\Bundle\CompetitionBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use BettingSas\Bundle\CompetitionBundle\Document\Competition;

/**
 * Manager for competition
 *
 * @author jobou
 */
class CompetitionManager
{
    /**
     * @var \Doctrine\Common\Persistence\ManagerRegistry
     */
    protected $manager;

    /**
     * @var array
     */
    protected $eventMapping;

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ManagerRegistry $manager
     */
    public function __construct(ManagerRegistry $manager, array $eventMapping)
    {
        $this->manager = $manager;
        $this->eventMapping = $eventMapping;
    }

    /**
     * get repository for Competition
     *
     * @return \BettingSas\Bundle\CompetitionBundle\Document\Repository\CompetitionRepository
     */
    public function getRepository()
    {
        return $this->manager->getManager()->getRepository('BettingSasCompetitionBundle:Competition');
    }

    /**
     * Get manager
     *
     * @return \Doctrine\Common\Persistence\ManagerRegistry
     */
    public function getManager()
    {
        return $this->manager->getManager();
    }

    /**
     * Get the repository for the event
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Competition $competition
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getEventRepository()
    {
        return $this
            ->manager
            ->getManager()
            ->getRepository('BettingSas\Bundle\CompetitionBundle\Document\Event');
    }
}
