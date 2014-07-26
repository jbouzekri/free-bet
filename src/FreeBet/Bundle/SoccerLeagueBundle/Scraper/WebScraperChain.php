<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\Scraper;

use FreeBet\Bundle\SoccerLeagueBundle\Exception\WebScraperException;

/**
 * WebScraperChain
 *
 * @author jobou
 */
class WebScraperChain
{
    /**
     * @var array
     */
    private $scrapers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->scrapers = array();
    }

    /**
     * Add a scraper service
     *
     * @param string $scraper
     * @param string $alias
     */
    public function addScraper($scraper, $alias)
    {
        $this->scrapers[$alias] = $scraper;
    }

    /**
     * Get the scraper
     *
     * @param string $name
     *
     * @return type
     *
     * @throws \FreeBet\Bundle\SoccerLeagueBundle\Exception\WebScraperException
     */
    public function getScraper($name)
    {
        if (!isset($this->scrapers[$name])) {
            throw new WebScraperException(
                'Scraper '.$name.' does not exists. Did you define the service with the correct tag and alias ?'
            );
        }
        return $this->scrapers[$name];
    }
}
