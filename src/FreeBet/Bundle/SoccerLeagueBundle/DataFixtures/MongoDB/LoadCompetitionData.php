<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DataFixtures\MongoDB;

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
                'name' => 'Ligue 1 2014',
                'type' => 'soccer-league',
                'subType' => 'france',
                'reference' => 'ligue-1-2014',
                'endDate' => "2015-05-24"
            ),
            array(
                'name' => 'Premiere league 2014',
                'type' => 'soccer-league',
                'subType' => 'england',
                'reference' => 'premiere-league-2014',
                'endDate' => "2015-05-25"
            ),
            array(
                'name' => 'Liga 2014',
                'type' => 'soccer-league',
                'subType' => 'spain',
                'reference' => 'liga-2014',
                'endDate' => "2015-05-24"
            ),
            array(
                'name' => 'Serie A 2014',
                'type' => 'soccer-league',
                'subType' => 'italy',
                'reference' => 'serie-a-2014',
                'endDate' => "2015-06-01"
            ),
            array(
                'name' => 'Bundesliga 2014',
                'type' => 'soccer-league',
                'subType' => 'germany',
                'reference' => 'bundesliga-2014',
                'endDate' => "2015-05-24"
            )
        );
    }
}
