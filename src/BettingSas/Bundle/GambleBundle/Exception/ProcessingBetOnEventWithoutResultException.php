<?php

namespace BettingSas\Bundle\GambleBundle\Exception;

use BettingSas\Bundle\CompetitionBundle\Exception\BettingSasException;

/**
 * Description of ProcessingBetOnEventWithoutResultException
 *
 * @author jobou
 */
class ProcessingBetOnEventWithoutResultException extends BettingSasException
{
    protected $message = "Trying to process a bet on an event without knowing the result";
}
