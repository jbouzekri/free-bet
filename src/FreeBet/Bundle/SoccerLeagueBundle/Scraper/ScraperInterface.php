<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\Scraper;

/**
 * ScraperInterface
 *
 * @author jobou
 */
interface ScraperInterface
{
    /**
     * Refresh match data
     *
     * @param string $competitionSlug
     *
     * @return string
     */
    public function refreshData($competitionSlug);
}
