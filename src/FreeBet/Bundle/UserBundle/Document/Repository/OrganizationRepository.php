<?php

namespace FreeBet\Bundle\UserBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

/**
 * Description of OrganizationRepository
 *
 * @author jobou
 */
class OrganizationRepository extends DocumentRepository implements OrganizationRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findAllFilteredQb($slug = null)
    {
        $qb = $this->createQueryBuilder()
            ->sort('slug');

        if (null !== $slug) {
            $qb->field('slug')->equals(new \MongoRegex('/.*'.$slug.'.*/i'));
        }

        return $qb;
    }
}
