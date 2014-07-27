<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\Scraper;

use Guzzle\Service\Client;
use Symfony\Component\DomCrawler\Crawler;
use FreeBet\Bundle\CompetitionBundle\Model\EventFactory;

/**
 * LequipeScraper
 *
 * @author jobou
 */
class LequipeScraper implements ScraperInterface
{
    /**
     * Site base URL
     */
    const BASE_URL = 'http://www.lequipe.fr';

    /**
     * Selector used to find items
     *
     * @var array
     */
    protected static $selectors = array(
        'DAY_URLS' => 'select[name=IDNIVEAU]',
        'DAY' => 'h1 > span',
        'LINES' => '#CONT > div > div.ligne.bb-color, #CONT > div > h2',
        'DATE_TAG' => 'h2',
        'LEFT_TEAM' => '.equipeDom a',
        'RIGHT_TEAM' => '.equipeExt a',
        'HOUR' => '.score a.disabled'
    );

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $client;

    /**
     * @var \FreeBet\Bundle\CompetitionBundle\Model\EventFactory
     */
    private $factory;

    /**
     * @var MatchWriter
     */
    private $writer;

    /**
     * Constructor
     *
     * @param \Guzzle\Service\Client $restClient
     * @param string $url
     * @param \FreeBet\Bundle\CompetitionBundle\Model\EventFactory $factory
     * @param \FreeBet\Bundle\SoccerLeagueBundle\Scraper\MatchWriter $writer
     */
    public function __construct(Client $restClient, $url, EventFactory $factory, MatchWriter $writer)
    {
        $this->client = $restClient;
        $this->url = $url;
        $this->factory = $factory;
        $this->writer = $writer;
    }

    /**
     * Refresh all matches data
     *
     * @return string
     */
    public function refreshData()
    {
        $content = "";
        foreach ($this->getDates() as $url) {
            $matches = $this->getMatches($url);
            $content .= $this->writer->dumpArray($matches, "csv");
        }

        return $content;
    }

    /**
     * Get all dates page url
     *
     * @return array
     */
    public function getDates()
    {
        $dates = array();

        $crawler = $this->loadContentInCrawlerFromUrl($this->url);
        $crawler->filter(self::$selectors['DAY_URLS'])->eq(0)->filter('option')->each(function ($item) use (&$dates) {
            $dates[] = self::BASE_URL . $item->attr('value');
        });

        return $dates;
    }

    /**
     * Parse a day page and extract matches
     *
     * @param string $url
     *
     * @return array
     */
    public function getMatches($url)
    {
        $matches = array();
        $crawler = $this->loadContentInCrawlerFromUrl($url);

        $day = $crawler->filter(self::$selectors['DAY'])->eq(0)->text();
        $day = (int) trim($day);

        $date = null;
        foreach ($crawler->filter(self::$selectors['LINES']) as $key => $item) {
            $itemCrawler = new Crawler($item);
            if ($itemCrawler->getNode(0)->tagName == self::$selectors['DATE_TAG']) {
                $date = $this->transformDateToDateTime($itemCrawler->text());
            } else {
                $leftTeam = $this->cleanText($itemCrawler->filter(self::$selectors['LEFT_TEAM'])->text());
                $rightTeam = $this->cleanText($itemCrawler->filter(self::$selectors['RIGHT_TEAM'])->text());
                $hourData = explode('h', trim($itemCrawler->filter(self::$selectors['HOUR'])->text()));
                $hour = $hourData[0];
                $minutes = $hourData[1];

                $matches[] = $this->createMatch($date, $day, $leftTeam, $rightTeam, $hour, $minutes);
            }
        }

        return $matches;
    }

    /**
     * Create a match instance
     *
     * @param \DateTime $date
     * @param int $day
     * @param string $leftTeam
     * @param string $rightTeam
     * @param string $hour
     * @param string $minutes
     *
     * @return \FreeBet\Bundle\SoccerBundle\Document\Match
     */
    protected function createMatch(\DateTime $date, $day, $leftTeam, $rightTeam, $hour, $minutes)
    {
        $match = $this->factory->getInstance('soccer');
        $match->setLeftName($leftTeam);
        $match->setRightName($rightTeam);

        $dateEvent = clone $date;
        $dateEvent->setTime($hour, $minutes, 0);
        $dateEvent->setTimezone(new \DateTimeZone('UTC'));
        $match->setDate($dateEvent);

        $match->setType('soccer');
        $match->setPhaseOrder($day);
        $match->setPhase($day);

        return $match;
    }

    /**
     * Clean a text
     *
     * @param string $text
     *
     * @return string
     */
    protected function cleanText($text)
    {
        $text = trim($text);
        if (preg_match('/(\w+).*\(\d+\)/', $text, $matches)) {
            $text = $matches[1];
        }

        // Hotfix for some team names
        if ($text == 'Paris') {
            $text = 'Paris-SG';
        }
        if ($text == 'Evian') {
            $text = 'Evian-TG';
        }

        return $text;
    }

    /**
     * Transform a date string to DateTime
     *
     * @param string $date
     *
     * @return \DateTime
     */
    protected function transformDateToDateTime($date)
    {
        $date = trim($date);
        preg_match('/^.*\ ([0-9]{1,2}.*[0-9]{4})$/', $date, $matches);
        $date = $matches[1] . " 00:00:00";
        $date = str_replace(
            array(
                '1er',
                'janvier',
                'février',
                'mars',
                'avril',
                'mai',
                'juin',
                'août',
                'septembre',
                'octobre',
                'novembre',
                'décembre'
            ),
            array(
                '1',
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'August',
                'September',
                'October',
                'November',
                'December'
            ),
            $date
        );

        return \DateTime::createFromFormat("j F Y H:i:s", $date, new \DateTimeZone('Europe/Paris'));
    }

    /**
     * Make a GET call with the url to load page content
     *
     * @param string $url
     * @return \Symfony\Component\DomCrawler\Crawler
     */
    protected function loadContentInCrawlerFromUrl($url)
    {
        $request = $this->client->get($url);
        $response = $this->client->send($request);

        return new Crawler((string) $response->getBody());
    }
}
