<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DataFixtures\MongoDB;

/**
 * LoadSerieA2014Data
 *
 * @author jobou
 */
class LoadSerieA2014Data extends AbstractLeagueData
{
    /**
     * {@inheritDoc}
     */
    protected function getCompetitionReference()
    {
        return "serie-a-2014";
    }
}
