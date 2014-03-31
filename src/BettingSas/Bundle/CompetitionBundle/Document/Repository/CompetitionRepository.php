<?php

namespace BettingSas\Bundle\CompetitionBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Description of CompetitionRepository
 *
 * @author jobou
 */
class CompetitionRepository extends DocumentRepository implements CompetitionRepositoryInterface
{
    /**
     * @return array
     */
    public function findAllOrderedByDate()
    {
        return $this->createQueryBuilder()
            ->sort('name', 'ASC')
            ->getQuery()
            ->execute();
    }
}
