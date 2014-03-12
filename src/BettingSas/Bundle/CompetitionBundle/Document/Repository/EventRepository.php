<?php

namespace BettingSas\Bundle\CompetitionBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Description of CompetitionRepository
 *
 * @author jobou
 */
class EventRepository extends DocumentRepository implements EventRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findAllEndedAndNotProcessedEvent()
    {
        $qb = $this->createQueryBuilder()
            ->field('date')->lt(new \DateTime())
            ->field('processed')->equals(false);

        return $qb->getQuery()->execute();
    }

    /**
     * {@inheritDoc}
     */
    public function findNextEvents()
    {
        $qb = $this->createQueryBuilder()
            ->field('date')->gte(new \DateTime())
            ->field('processed')->equals(false)
            ->sort('date', 'asc');

        return $qb->getQuery()->execute();
    }

}
