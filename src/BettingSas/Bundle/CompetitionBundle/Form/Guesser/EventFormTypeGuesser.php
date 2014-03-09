<?php

namespace BettingSas\Bundle\CompetitionBundle\Form\Guesser;

use BettingSas\Bundle\CompetitionBundle\Document\Event;
use BettingSas\Bundle\CompetitionBundle\Exception\UnsupportedEventType;

/**
 * Description of EventFormTypeGuesser
 *
 * @author jobou
 */
class EventFormTypeGuesser
{
    /**
     * @var array
     */
    protected $guessers = array();

    public function addEventFormTypeGuesser(EventFormTypeGuesserInterface $formTypeGuesser, $type)
    {
        if (!isset($this->guessers[$type])) {
            $this->guessers[$type] = array();
        }

        $this->guessers[$type][] = $formTypeGuesser;
    }

    public function getFormType(Event $event, $options = array())
    {
        if (!isset($this->guessers[$event->getType()])) {
            throw new UnsupportedEventType($event->getType(). ' not supported. Try '.implode(', ', array_keys($this->gambles)));
        }

        $formType = null;
        foreach ($this->guessers[$event->getType()] as $guesser) {
            $formType = $guesser->getFormType($event);
            if (!is_null($formType)) {
                break;
            }
        }

        return $formType;
    }
}
