<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DataFixtures\MongoDB;

/**
 * LoadBundesliga2014Data
 *
 * @author jobou
 */
class LoadBundesliga2014Data extends AbstractLeagueData
{
    /**
     * {@inheritDoc}
     */
    protected function getCompetitionReference()
    {
        return "bundesliga-2014";
    }
}
