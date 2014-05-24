<?php

namespace FreeBet\Bundle\SoccerWorldCupBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use FreeBet\Bundle\CompetitionBundle\Document\Competition;
use FreeBet\Bundle\CompetitionBundle\DataFixtures\AbstractDataLoader;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadCompetitionData extends AbstractDataLoader implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * {@inheritDoc}
     */
    public function buildObject(array $data)
    {
        $entity = new Competition();
        $entity->setName($data['name']);
        $entity->setType($data['type']);

        return $entity;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        return array(
            array(
                'name' => 'Coupe du Monde 2014',
                'type' => 'soccer-world-cup',
                'reference' => 'world-cup-2014'
            )
        );
    }

}
