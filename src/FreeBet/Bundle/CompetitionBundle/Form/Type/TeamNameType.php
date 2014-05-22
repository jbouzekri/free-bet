<?php

namespace FreeBet\Bundle\CompetitionBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of TeamNameType
 *
 * @author jobou
 */
class TeamNameType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('leftName', 'text')
            ->add('rightName', 'text');
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => true
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'team_name';
    }
}
