<?php

namespace BettingSas\Bundle\GambleBundle\Twig;

use Twig_Environment as Environment;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Gamble\GambleChain;
use BettingSas\Bundle\GambleBundle\Manager\GambleCart;

class GambleExtension extends \Twig_Extension
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\Gamble\GambleChain
     */
    protected $gambles;

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
     * @param \BettingSas\Bundle\GambleBundle\Manager\GambleManager $manager
     */
    public function __construct(Environment $twig, GambleChain $gambles, GambleCart $cart)
    {
        $this->gambles = $gambles;
        $this->twig = $twig;
        $this->cart = $cart;
    }

    /**
     * Register twig functions
     *
     * @return array
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
        $gambles = $this->gambles->getGamblesByEventType($event->getType());

        foreach ($gambles as $gamble) {
            $html .= $this->twig->render($gamble->getTemplate(), array(
                'event' => $event,
                'gamble' => $gamble
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
            $gamble = $this->gambles->getGambleByEventTypeAndType($bet->getEvent()->getType(), $bet->getType());
            $html .= $this->twig->render($gamble->getCartTemplate(), array(
                'bet' => $bet,
                'gamble' => $gamble
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
