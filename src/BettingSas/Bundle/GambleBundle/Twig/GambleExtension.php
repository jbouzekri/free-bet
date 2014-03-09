<?php

namespace BettingSas\Bundle\GambleBundle\Twig;

use Twig_Environment as Environment;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Gamble\GambleChain;

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
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\Manager\GambleManager $manager
     */
    public function __construct(Environment $twig, GambleChain $gambles)
    {
        $this->gambles = $gambles;
        $this->twig = $twig;
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
        $gambles = $this->gambles->getGamblesByType($event->getType());

        foreach ($gambles as $gamble) {
            $html .= $this->twig->render($gamble->getTemplate(), array(
                'event' => $event,
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