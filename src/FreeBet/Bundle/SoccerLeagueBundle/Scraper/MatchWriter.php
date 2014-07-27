<?php

namespace FreeBet\Bundle\SoccerLeagueBundle\Scraper;

use FreeBet\Bundle\SoccerBundle\Document\Match;

/**
 * MatchWriter
 *
 * @author jobou
 */
class MatchWriter
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Constructor
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Dump to format
     *
     * @param \FreeBet\Bundle\SoccerBundle\Document\Match $match
     * @param string $type
     *
     * @return string
     */
    public function dump(Match $match, $type = "csv")
    {
        return $this->twig->render('FreeBetSoccerLeagueBundle:Export:match.'.$type.'.twig', array(
            'match' => $match
        ));
    }

    /**
     * Dump a list of matches to format
     *
     * @param array $matches
     * @param string $type
     *
     * @return string
     */
    public function dumpArray(array $matches, $type = "csv")
    {
        $result = "";
        foreach ($matches as $match)
        {
            $result .= $this->dump($match, $type);
        }

        return $result;
    }
}
