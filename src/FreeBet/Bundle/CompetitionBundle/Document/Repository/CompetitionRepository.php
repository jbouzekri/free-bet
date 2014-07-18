<?php

namespace FreeBet\Bundle\CompetitionBundle\Document\Repository;

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
    public function findCurrentOrderedByDate()
    {
        return $this->createQueryBuilder()
            ->field('endDate')->gte(new \DateTime())
            ->sort('name', 'ASC')
            ->getQuery()
            ->execute();
    }
}
