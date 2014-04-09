<?php

namespace BettingSas\Bundle\CompetitionBundle\Twig;

use Twig_Environment as Environment;
use BettingSas\Bundle\CompetitionBundle\Document\Event;

class EventExtension extends \Twig_Extension
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
    public function __construct(Environment $twig)
    {
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
                'event_name',
                array( $this, 'eventName' ),
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * event_name twig function
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return string
     */
    public function eventName(Event $event)
    {
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
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'event_extension';
    }
}
