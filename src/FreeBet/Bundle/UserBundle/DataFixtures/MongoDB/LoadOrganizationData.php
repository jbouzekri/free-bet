<?php

namespace FreeBet\Bundle\UserBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use FreeBet\Bundle\UserBundle\Document\Organization;
use FreeBet\Bundle\CompetitionBundle\DataFixtures\AbstractDataLoader;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadOrganizationData extends AbstractDataLoader implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function buildObject(array $data)
    {
        $entity = new Organization();
        $entity->setName($data['name']);

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        return array(
            'bu-helios' => array(
                'name' => 'BU Helios',
                'reference' => 'organization-bu-helios'
            )
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 15;
    }
}
