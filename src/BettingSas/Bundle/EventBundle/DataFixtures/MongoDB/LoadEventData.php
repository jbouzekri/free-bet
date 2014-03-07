<?php

namespace BettingSas\Bundle\EventBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BettingSas\Bundle\EventBundle\Document\Event;

/**
 * Description of LoadEventData
 *
 * @author jobou
 */
class LoadEventData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $events = array(
            array(
                'name' => 'Coupe du Monde 2014'
            )
        );

        foreach ($events as $event) {
            $entity = new Event();
            $entity->setName($event['name']);

            $manager->persist($entity);
        }

        $manager->flush();
    }
}