<?php

namespace FreeBet\Bundle\GambleBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use FreeBet\Bundle\CompetitionBundle\Document\Event;
use FreeBet\Bundle\UserBundle\Document\User;
use Doctrine\MongoDB\Exception\ResultException;

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
    public function countAllGambleHavingBetsOnEventWithType(User $user, Event $event, $betType)
    {
        $qb = $this->getAllGambleHavingBetsOnEventQb($event);
        $qb->count()
            ->field('user.id')->equals($user->getId())
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
     * @param \FreeBet\Bundle\CompetitionBundle\Document\Event $event
     *
     * @return \Doctrine\ODM\MongoDB\Query\Builder
     */
    protected function getAllGambleHavingBetsOnEventQb(Event $event)
    {
        $qb = $this->createQueryBuilder()
            ->field('bets.event.$id')->equals(new \MongoId($event->getId()));

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllGambleForUserQb(User $user, $onlyWinner = null)
    {
        $qb = $this->createQueryBuilder()
            ->field('user.id')->equals($user->getId())
            ->sort('created', 'DESC');

        if ($onlyWinner !== null) {
            $qb->field('winner')->equals($onlyWinner);
        }

        return $qb;
    }

    /**
     * {@inheritDoc}
     */
    public function getGambleProcessedStats(User $user)
    {
        $results = array(
            "unprocessed" => 0,
            "winner" => 0,
            "loser" => 0
        );

        $qb = $this->createQueryBuilder()
            ->field('user.id')->equals($user->getId())
            ->map('function() {
                if (typeof this.processedDate == "undefined") {
                    emit("unprocessed", 1);
                } else if (this.winner === true) {
                    emit("winner", 1);
                } else if (this.winner === false) {
                    emit("loser", 1);
                }
            }')
            ->reduce('function(k, vals) {
                var sum = 0;
                for (var i in vals) {
                    sum += vals[i];
                }
                return sum;
            }');

        try {
            $mapResults = $qb->getQuery()->execute();
        } catch (ResultException $e) {
            $mapResults = array();
        }

        foreach ($mapResults as $value) {
            $results[$value["_id"]] = $value["value"];
        }

        return $results;
    }

    /**
     * {@inheritDoc}
     */
    public function getGambleResultStats(User $user)
    {
        $collection = $this->getDocumentManager()->getDocumentCollection($this->getClassName());
        $db = $collection->getDatabase();

        $result = $db->command(array(
            'aggregate' => $collection->getName(),
            'pipeline'  => array(
                array('$match' => array(
                    'user.$id' => new \MongoId($user->getId())
                )),
                array('$group'  => array(
                    '_id' => null,
                    'total_gamble' => array('$sum' => 1),
                    'total_point' => array('$sum' => '$point'),
                ))
            ),
        ));

        $groupResult = array(
            'total_gamble' => 0,
            'total_point' => 0
        );
        if (isset($result['ok']) && isset($result['result'][0])) {
            $groupResult = $result['result'][0];
        }

        return $groupResult;
    }
}
