<?php

namespace BettingSas\Bundle\GambleBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of BetRepository
 *
 * @author jobou
 */
class BetRepository extends DocumentRepository
{
    /**
     * @return type
     */
    public function removeBetOnEvent(Event $event)
    {
        return $this->createQueryBuilder()
            ->createQueryBuilder()
            ->remove()
            ->field('event')->equals($event)
            ->getQuery()
            ->execute();
    }
}