<?php

namespace BettingSas\Bundle\GambleBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of GambleRepository
 *
 * @author jobou
 */
class GambleRepository extends DocumentRepository implements GambleRepositoryInterface
{
    // TODO : remove $id in field
    // use
    // field('bets.event')
    //  ->equals(\MongoDBRef::create("event", new \MongoId('4e63611cbc347053a2000001'),'database_name'))
    // to ensure index use
    /**
     * {@inheritDoc}
     */
    public function findAllGambleHavingBetsOnEvent(Event $event)
    {
        $qb = $this->getAllGambleHavingBetsOnEventQb($event);

        return $qb->getQuery()->execute();
    }

    /**
     * {@inheritDoc}
     */
    public function countAllGambleHavingBetsOnEventWithType(Event $event, $betType)
    {
        $qb = $this->getAllGambleHavingBetsOnEventQb($event);
        $qb->count()
            ->field('bets.type')->equals($betType);

        return $qb->getQuery()->execute();
    }

    /**
     * {@inheritDoc}
     */
    public function findAllGambleWithProcessedBets()
    {
        $qb = $this->createQueryBuilder()
            ->field('winner')->exists(false)
            ->field('bets.winner')->exists(true);

        return $qb->getQuery()->execute();
    }

    /**
     * Get the query builder base to get all gamble having bets on a specific event
     *
     * @param \BettingSas\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    protected function getAllGambleHavingBetsOnEventQb(Event $event)
    {
        $qb = $this->createQueryBuilder()
            ->field('bets.event.$id')->equals(new \MongoId($event->getId()));

        return $qb;
    }
}
