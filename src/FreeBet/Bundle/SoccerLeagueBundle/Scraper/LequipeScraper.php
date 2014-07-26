<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\Scraper;

/**
 * LequipeScraper
 *
 * @author jobou
 */
class LequipeScraper
{
    /**
     * @var string
     */
    private $url;

    /**
     * Constructor
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    private function loadFirstPage()
    {

    }

    /**
     * Refresh all matches data
     *
     * @return string
     */
    public function refreshMatchData()
    {

        return 'data';
    }
}
