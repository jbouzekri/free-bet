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
    private static $key = 1;

    /**
     * {@inheritDoc}
     */
    public function buildObject(array $data)
    {
        $entity = new Organization();
        $entity->setName("Organization ".self::$key);

        self::$key++;

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        $data = range(1, 100);
        $data = array_map(function ($item) {
            return array($item);
        }, $data);

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
