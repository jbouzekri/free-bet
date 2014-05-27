<?php

namespace FreeBet\Bundle\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class ProfileType
 *
 * @author jobou
 */
class ProfileType extends ProfileFormType
{
    /**
     * @var \Symfony\Component\Translation\TranslatorInterface
     */
    protected $translator;

    /**
     * Constructor
     *
     * @param string $class
     */
    public function __construct(TranslatorInterface $translator, $class)
    {
        $this->translator = $translator;

        parent::__construct($class);
    }

    /**
     * {@inheritDoc}
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildUserForm($builder, $options);

        $choices = array(
            'en' => $this->translator->trans('language.en'),
            'fr' => $this->translator->trans('language.fr'),
        );

        $builder
            ->add('language', 'choice', array('choices' => $choices))
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'freebet_user_profile';
    }
}
