<?php

namespace BettingSas\Bundle\SoccerBundle\Gamble;

use BettingSas\Bundle\GambleBundle\Gamble\GambleInterface;
use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of WinnerGamble
 *
 * @author jobou
 */
class WinnerGamble implements GambleInterface
{
    use \BettingSas\Bundle\GambleBundle\Gamble\Tools\TranslatorTool;

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
     * Get the label according to the selected choice
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     * @param string $choice
     * @return string
     */
    public function getChoiceLabel(Event $event, $choice)
    {
        $label = $choice;
        switch ($choice) {
            case '1':
                $label = $event->getLeftName();
                break;

            case 'N':
                $label = $this->getTranslator()->trans('gamble_'.$this->getName().'_N', array(), 'gamble');
                break;

            case '2':
                $label = $event->getRightName();
                break;
        }

        return $label;
    }

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

    /**
     * {@inheritDoc}
     */
    public function getCartTemplate()
    {
        return 'BettingSasSoccerBundle:Gamble:Cart/winner.html.twig';
    }

}
