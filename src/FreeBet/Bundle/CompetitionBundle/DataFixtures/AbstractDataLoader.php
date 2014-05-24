<?php

namespace FreeBet\Bundle\CompetitionBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

/**
 * Description of AbstractDataLoader
 *
 * @author jobou
 */
abstract class AbstractDataLoader extends AbstractFixture implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $entity = $this->buildObject($data);

            $manager->persist($entity);

            if (isset($data['reference'])) {
                $this->addReference($data['reference'], $entity);
            }
        }

        $manager->flush();
    }

    /**
     * Data to import
     *
     * @return array
     */
    abstract public function getData();

    /**
     * Build the object to persist
     *
     * @return mixed
     */
    abstract public function buildObject(array $data);
}
