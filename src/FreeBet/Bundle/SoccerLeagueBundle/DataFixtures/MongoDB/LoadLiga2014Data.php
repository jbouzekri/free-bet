<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DataFixtures\MongoDB;

/**
 * LoadLigue12014Data
 *
 * @author jobou
 */
class LoadLiga2014Data extends AbstractLeagueData
{
    /**
     * {@inheritDoc}
     */
    protected function getCompetitionReference()
    {
        return "liga-2014";
    }
}
