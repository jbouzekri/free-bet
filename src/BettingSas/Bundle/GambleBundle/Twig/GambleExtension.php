<?php

namespace BettingSas\Bundle\GambleBundle\Twig;

use Twig_Environment as Environment;
use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\BetType\BetTypeChain;
use BettingSas\Bundle\GambleBundle\Document\Bet;

class GambleExtension extends \Twig_Extension
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain
     */
    protected $betTypeChain;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Constructor
     *
     * @param \Twig_Environment $twig
     * @param \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain $betTypeChain
     */
    public function __construct(Environment $twig, BetTypeChain $betTypeChain)
    {
        $this->betTypeChain = $betTypeChain;
        $this->twig = $twig;
    }

    /**
     * Register twig functions
     *
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction(
                'render_main_bet_type',
                array( $this, 'renderMainBetTypes' ),
                array('is_safe' => array('html'))
            ),
            new \Twig_SimpleFunction(
                'render_all_bet_types',
                array( $this, 'renderAllBetTypes' ),
                array('is_safe' => array('html'))
            ),
            new \Twig_SimpleFunction(
                'render_cart_bet',
                array($this, 'renderCartBet'),
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * render_main_bet_type twig function
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return string
     */
    public function renderMainBetTypes(Event $event)
    {
        $betTypes = $this->betTypeChain->findByEventType($event->getType());

        if (count($betTypes) == 0) {
            return '';
        }

        $betType = reset($betTypes);
        return $this->twig->render($betType->getTemplate(), array(
            'event' => $event,
            'betType' => $betType
        ));
    }

    /**
     * render_all_bet_types twig function
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return string
     */
    public function renderAllBetTypes(Event $event)
    {
        $html    = "";
        $betTypes = $this->betTypeChain->findByEventType($event->getType());

        foreach ($betTypes as $betType) {
            $html .= $this->twig->render($betType->getTemplate(), array(
                'event' => $event,
                'betType' => $betType
            ));
        }

        return $html;
    }

    /**
     * render_cart_bet twig function
     *
     * @param \BettingSas\Bundle\GambleBundle\Document\Bet $bet
     *
     * @return string
     */
    public function renderCartBet(Bet $bet)
    {
        $betTypeEntity = $this->betTypeChain->findByEventTypeAndType($bet->getEvent()->getType(), $bet->getType());

        return $this->twig->render($betTypeEntity->getCartTemplate(), array(
            'bet' => $bet,
            'betType' => $betTypeEntity
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'gamble_extension';
    }
}
