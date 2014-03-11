<?php

namespace BettingSas\Bundle\CompetitionBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use BettingSas\Bundle\CompetitionBundle\Document\Competition;

/**
 * Manager for competition
 *
 * @author jobou
 */
class CompetitionManager
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $om;

    /**
     * @var array
     */
    protected $eventMapping;

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * get repository for Competition
     *
     * @return \BettingSas\Bundle\CompetitionBundle\Document\Repository\CompetitionRepository
     */
    public function getRepository()
    {
        return $this->om->getRepository('BettingSasCompetitionBundle:Competition');
    }

    /**
     * Get manager
     *
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    public function getManager()
    {
        return $this->om;
    }

    /**
     * Get the repository for the event
     *
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getEventRepository()
    {
        return $this->om->getRepository('BettingSas\Bundle\CompetitionBundle\Document\Event');
    }
}
