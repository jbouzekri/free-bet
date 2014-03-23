<?php

namespace BettingSas\Bundle\UserBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use BettingSas\Bundle\UserBundle\Document\Organization;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadOrganizationData extends AbstractFixture implements
    FixtureInterface,
    OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $organizations = array(
            'bu-helios' => array(
                'name' => 'BU Helios'
            )
        );

        foreach ($organizations as $key => $organization) {
            $entity = new Organization();
            $entity->setName($organization['name']);

            $manager->persist($entity);

            $this->addReference('organization-'.$key, $entity);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 15;
    }
}
