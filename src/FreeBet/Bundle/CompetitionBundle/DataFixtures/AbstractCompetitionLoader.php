<?php

namespace FreeBet\Bundle\CompetitionBundle\DataFixtures;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use FreeBet\Bundle\CompetitionBundle\Document\Competition;

/**
 * Description of AbstractCompetitionLoader
 *
 * @author jobou
 */
abstract class AbstractCompetitionLoader extends AbstractDataLoader implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    abstract public function getOrder();

    /**
     * {@inheritDoc}
     */
    public function buildObject(array $data)
    {
        $entity = new Competition();
        $entity->setName($data['name']);
        $entity->setType($data['type']);
        $entity->setSubType($data['subType']);
        $entity->setEndDate(\DateTime::createFromFormat('Y-m-d', $data['endDate']));

        return $entity;
    }
}
