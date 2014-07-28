<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DataFixtures\MongoDB;

use FreeBet\Bundle\SoccerWorldCupBundle\DataFixtures\MongoDB\LoadMatchData;

/**
 * AbstractLeagueData
 *
 * @author jobou
 */
abstract class AbstractLeagueData extends LoadMatchData
{
    /**
     * The reference to load
     *
     * @return string
     */
    protected abstract function getCompetitionReference();

    /**
     * {@inheritDoc}
     */
    public function buildObject(array $data)
    {
        return $this->createMatch($data, $this->getCompetitionReference());
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
            '/../src/FreeBet/Bundle/SoccerLeagueBundle/Resources/data/'.$this->getCompetitionReference().'.csv';

        return $this->container
            ->get('free_bet.data_loader.csv_file')
            ->readFile($file);
    }
}
