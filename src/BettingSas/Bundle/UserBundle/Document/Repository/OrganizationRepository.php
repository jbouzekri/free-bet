<?php

namespace BettingSas\Bundle\UserBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Description of OrganizationRepository
 *
 * @author jobou
 */
class OrganizationRepository extends DocumentRepository
{
    /**
     * Find all sorted By name
     * You can filter by slug
     *
     * @param string $slug
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    public function getAllSortedByNameQb($slug = null)
    {
        $qb = $this->createQueryBuilder()
            ->sort('slug');

        if (null !== $slug) {
            $qb->field('slug')->equals(new \MongoRegex('/.*'.$slug.'.*/i'));
        }

        return $qb;
    }
}
