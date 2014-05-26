<?php

namespace FreeBet\Bundle\SoccerBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Constraints\Choice;
use FreeBet\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface;

/**
 * Description of TeamNameSubscriber
 *
 * @author jobou
 */
class TeamNameSubscriber implements EventSubscriberInterface
{
    /**
     * @var \FreeBet\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface
     */
    protected $eventRepository;

    /**
     * Constructor
     *
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface $eventRepository
     */
    public function __construct(EventRepositoryInterface $eventRepository = null)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData'
        );
    }

    /**
     * Modify form to set team feild type as choice instead of text
     *
     * @param \Symfony\Component\Form\FormEvent $event
     *
     * @return void
     */
    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $competition = $event->getData()->getCompetition();

        if ($this->eventRepository !== null && $competition) {
            $choices = $this
                ->eventRepository
                ->getEventTeamNameChoices($competition);

            $nameFieldOption = array(
                'choices'=>$choices,
                'constraints' => array(
                    new Choice(array('choices'=>  array_keys($choices)))
                )
            );
            $form->get('teamName')->add('leftName', 'choice', $nameFieldOption);
            $form->get('teamName')->add('rightName', 'choice', $nameFieldOption);
        }
    }
}
