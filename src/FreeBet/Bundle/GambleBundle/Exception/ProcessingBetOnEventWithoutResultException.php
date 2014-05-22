<?php

namespace FreeBet\Bundle\GambleBundle\Exception;

use FreeBet\Bundle\CompetitionBundle\Exception\FreeBetException;

/**
 * Description of ProcessingBetOnEventWithoutResultException
 *
 * @author jobou
 */
class ProcessingBetOnEventWithoutResultException extends FreeBetException
{
    protected $message = "Trying to process a bet on an event without knowing the result";
}
