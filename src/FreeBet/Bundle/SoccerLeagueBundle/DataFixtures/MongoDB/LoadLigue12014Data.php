<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DataFixtures\MongoDB;

use FreeBet\Bundle\SoccerWorldCupBundle\DataFixtures\MongoDB\LoadMatchData;

/**
 * LoadLigue12014Data
 *
 * @author jobou
 */
class LoadLigue12014Data extends LoadMatchData
{
    const COMPETITION_REFERENCE = "ligue-1-2014";

    /**
     * {@inheritDoc}
     */
    public function buildObject(array $data)
    {
        return $this->createMatch($data, self::COMPETITION_REFERENCE);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 11;
    }

    /**
     * {@inheritDoc}
     */
    public function getData()
    {
        $file = $this->container->getParameter('kernel.root_dir') .
            '/../src/FreeBet/Bundle/SoccerLeagueBundle/Resources/data/'.self::COMPETITION_REFERENCE.'.csv';

        return $this->container
            ->get('free_bet.data_loader.csv_file')
            ->readFile($file);
    }
}
