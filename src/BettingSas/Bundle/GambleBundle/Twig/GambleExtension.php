<?php

namespace BettingSas\Bundle\GambleBundle\Twig;

use Twig_Environment as Environment;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\GambleBundle\Manager\GambleManager;

class GambleExtension extends \Twig_Extension
{
    /**
     * @var \BettingSas\Bundle\GambleBundle\Manager\GambleManager
     */
    protected $manager;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * Constructor
     *
     * @param \BettingSas\Bundle\GambleBundle\Manager\GambleManager $manager
     */
    public function __construct(Environment $twig, GambleManager $manager)
    {
        $this->manager = $manager;
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
        $gambles = $this->manager->getGambleEntities($event);

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