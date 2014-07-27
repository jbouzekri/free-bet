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
     * @return string
     */
    public function refreshData();

    /**
     * Get all dates page url
     *
     * @return array
     */
    public function getDates();

    /**
     * Parse a day page and extract matches
     *
     * @param string $url
     *
     * @return array
     */
    public function getMatches($url);
}
