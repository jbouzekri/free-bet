<?php

namespace BettingSas\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class SelectOrganizationType
 *
 * @author jobou
 */
class SelectOrganizationType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $organizationConfiguration = array(
            'class' => 'BettingSasUserBundle:Organization',
            'property' => 'name',
            'expanded' => true
        );
        if (is_array($options['choices'])) {
            $organizationConfiguration['choices'] = $options['choices'];
        }

        $builder->add('organization', 'document', $organizationConfiguration);
        $builder->add('select', 'submit');
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'select_organization';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => null,
        ));
    }
}
