<?php

namespace FreeBet\Bundle\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;

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
    private $defaultTimezone;

    /**
     * Constructor
     *
     * @param string $class The User class name
     * @param string $defaultTimezone the default timezone
     */
    public function __construct($class, $defaultTimezone)
    {
        parent::__construct($class);
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
    public function getName()
    {
        return 'freebet_user_registration';
    }
}
