<?php

namespace BettingSas\Bundle\EventBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Description of EventRepository
 *
 * @author jobou
 */
class EventRepository extends DocumentRepository
{
    /**
     *
     * @return type
     */
    public function findAllOrderedByDate()
    {
        return $this->createQueryBuilder()
            ->sort('name', 'ASC')
            ->getQuery()
            ->execute();
    }
}