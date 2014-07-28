<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\DataFixtures\MongoDB;

/**
 * LoadPremiereLeague2014Data
 *
 * @author jobou
 */
class LoadPremiereLeague2014Data extends AbstractLeagueData
{
    /**
     * {@inheritDoc}
     */
    protected function getCompetitionReference()
    {
        return "premiere-league-2014";
    }
}
