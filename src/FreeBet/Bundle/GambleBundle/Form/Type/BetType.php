<?php

namespace FreeBet\Bundle\GambleBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', 'text', array(
            'required'=>true
        ));
        $builder->add('choice', 'text', array(
            'required'=>true
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FreeBet\Bundle\GambleBundle\Document\Bet',
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'bet';
    }
}
