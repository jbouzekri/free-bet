<?php

namespace BettingSas\Bundle\SoccerBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Gamble\GambleInterface;

/**
 * Description of WinnerGamble
 *
 * @author jobou
 */
class WinnerGamble implements GambleInterface
{
    /**
     * Choices available in gamble
     *
     * @var array
     */
    protected $choices = array(
        '1',
        'N',
        '2'
    );

    /**
     * Get the template use to render the gamble
     *
     * @return string
     */
    public function getTemplate()
    {
        return 'BettingSasSoccerBundle:Gamble:winner.html.twig';
    }

    /**
     * Get choices available in gamble
     *
     * @return array
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * Get name of gamble
     *
     * @return string
     */
    public function getName()
    {
        return 'winner';
    }
}
