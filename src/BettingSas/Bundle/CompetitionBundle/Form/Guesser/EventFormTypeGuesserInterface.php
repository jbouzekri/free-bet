<?php

namespace BettingSas\Bundle\CompetitionBundle\Form\Guesser;

/**
 * Description of EventFormTypeGuesserInterface
 *
 * @author jobou
 */
interface EventFormTypeGuesserInterface
{
    public function getFormType($event);
}
