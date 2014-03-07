<?php

namespace BettingSas\Bundle\CompetitionBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use BettingSas\Bundle\CompetitionBundle\Document\Competition;

/**
 * Description of CompetitionManager
 *
 * @author jobou
 */
class CompetitionManager
{
    /**
     *
     * @var \Doctrine\Common\Persistence\ManagerRegistry
     */
    protected $manager;

    /**
     *
     * @var array
     */
    protected $eventMapping;

    /**
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
     * @return \BettingSas\Bundle\CompetitionBundle\Document\Repository\CompetitionRepository
     */
    public function getRepository()
    {
        return $this->manager->getManager()->getRepository('BettingSasCompetitionBundle:Competition');
    }

    public function findAllEvents(Competition $competition)
    {
        if (!isset($this->eventMapping[$competition->getType()])) {
            throw new Exception\UnsupportedCompetitionType($competition->getType(). ' not supported. Try '.implode(', ', array_keys($this->eventMapping)));
        }

        return $this
            ->manager
            ->getManager()
            ->getRepository($this->eventMapping[$competition->getType()])
            ->findAll();
    }
}
