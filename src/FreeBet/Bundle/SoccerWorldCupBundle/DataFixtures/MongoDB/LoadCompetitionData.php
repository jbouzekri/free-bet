<?php

namespace FreeBet\Bundle\SoccerWorldCupBundle\DataFixtures\MongoDB;

use FreeBet\Bundle\CompetitionBundle\DataFixtures\AbstractCompetitionLoader;

/**
 * Description of LoadCompetitionData
 *
 * @author jobou
 */
class LoadCompetitionData extends AbstractCompetitionLoader
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
    public function getData()
    {
        return array(
            array(
                'name' => 'Coupe du Monde 2014',
                'type' => 'soccer-world-cup',
                'subType' => null,
                'reference' => 'world-cup-2014',
                'endDate' => "2014-07-14"
            )
        );
    }
}
