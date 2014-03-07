<?php

namespace BettingSas\Bundle\SoccerWorldCupBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BettingSas\Bundle\CompetitionBundle\Document\Competition;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadCompetitionData implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $competitions = array(
            array(
                'name' => 'Coupe du Monde 2014',
                'type' => 'soccer-world-cup'
            )
        );

        foreach ($competitions as $competition) {
            $entity = new Competition();
            $entity->setName($competition['name']);
            $entity->setType($competition['type']);

            $manager->persist($entity);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}