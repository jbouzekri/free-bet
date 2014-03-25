<?php

namespace BettingSas\Bundle\GambleBundle\Twig;

use Twig_Environment as Environment;
use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\BetType\BetTypeChain;
use BettingSas\Bundle\GambleBundle\Manager\GambleCart;

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
     * @var \BettingSas\Bundle\GambleBundle\Manager\GambleCart
     */
    protected $cart;

    /**
     * Constructor
     *
     * @param \Twig_Environment $twig
     * @param \BettingSas\Bundle\GambleBundle\BetType\BetTypeChain $betTypeChain
     * @param \BettingSas\Bundle\GambleBundle\Manager\GambleCart $cart
     */
    public function __construct(Environment $twig, BetTypeChain $betTypeChain, GambleCart $cart)
    {
        $this->betTypeChain = $betTypeChain;
        $this->twig = $twig;
        $this->cart = $cart;
    }

    /**
     * Register twig functions
     *
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('render_gamble', array($this, 'renderGamble'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('render_cart', array($this, 'renderCart'), array('is_safe' => array('html'))),
        );
    }

    /**
     * render_gamble twig function
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return string
     */
    public function renderGamble(Event $event)
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
     * render_cart twig function
     */
    public function renderCart()
    {
        $html = "";

        $bets = $this->cart->getGamble()->getBets();
        foreach ($bets as $bet) {
            $betTypeEntity = $this->betTypeChain->findByEventTypeAndType($bet->getEvent()->getType(), $bet->getType());
            $html .= $this->twig->render($betTypeEntity->getCartTemplate(), array(
                'bet' => $bet,
                'betType' => $betTypeEntity
            ));
        }
        return $html;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'gamble_extension';
    }
}
