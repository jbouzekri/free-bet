<?php

namespace FreeBet\Bundle\UserBundle\DataFixtures\Additionnal;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use FreeBet\Bundle\UserBundle\Document\Organization;

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
        for ($i=1; $i<=100; $i++) {
            $entity = new Organization();
            $entity->setName("Organization ".$i);

            $manager->persist($entity);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100;
    }
}
