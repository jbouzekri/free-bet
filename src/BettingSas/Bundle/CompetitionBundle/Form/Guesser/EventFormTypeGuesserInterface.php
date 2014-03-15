<?php

namespace BettingSas\Bundle\CompetitionBundle\Form\Guesser;

/**
 * Description of EventFormTypeGuesserInterface
 *
 * @author jobou
 */
interface EventFormTypeGuesserInterface
{
    /**
     * @return \Symfony\Component\Form\AbstractType
     */
    public function getFormType($event);
}
