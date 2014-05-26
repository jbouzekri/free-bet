<?php

namespace FreeBet\Bundle\SoccerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FreeBet\Bundle\SoccerBundle\Form\EventListener\TeamNameSubscriber;
use FreeBet\Bundle\CompetitionBundle\Form\Type\TeamNameType;
use FreeBet\Bundle\CompetitionBundle\Document\Repository\EventRepositoryInterface;

class MatchType extends AbstractType
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('teamName', new TeamNameType($this->eventRepository), array(
            'label' => false
        ));

        $builder->add('leftTeamHalfTimeScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamHalfTimeScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('leftTeamScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('leftTeamAfterExtendedTimeScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamAfterExtendedTimeScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('leftTeamPenaltyScore', 'integer', array(
            'required'=>false
        ));
        $builder->add('rightTeamPenaltyScore', 'integer', array(
            'required'=>false
        ));

        $builder->addEventSubscriber(new TeamNameSubscriber($this->eventRepository));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FreeBet\Bundle\SoccerBundle\Document\Match',
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'match';
    }
}
