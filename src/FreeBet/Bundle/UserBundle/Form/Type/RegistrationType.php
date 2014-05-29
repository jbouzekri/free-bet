<?php

namespace FreeBet\Bundle\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of RegistrationType
 *
 * @author jobou
 */
class RegistrationType extends RegistrationFormType
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $defaultTimezone;

    /**
     * Constructor
     *
     * @param string $class The User class name
     * @param string $defaultTimezone the default timezone
     */
    public function __construct($class, $defaultTimezone)
    {
        $this->class = $class;
        $this->defaultTimezone = $defaultTimezone;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->add('timezone', 'timezone', array('preferred_choices' => array($this->defaultTimezone)));
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'registration',
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'freebet_user_registration';
    }
}
