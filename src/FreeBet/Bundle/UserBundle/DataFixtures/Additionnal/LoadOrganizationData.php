<?php

namespace FreeBet\Bundle\UserBundle\DataFixtures\Additionnal;

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
        $data = array();
        for ($i=1; $i<101; $i++) {
            $data[] = array(
                'name' => "Organization ".$i,
            );
        }

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100;
    }
}
