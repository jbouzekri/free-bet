<?php

namespace FreeBet\Bundle\CompetitionBundle\Document\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use FreeBet\Bundle\CompetitionBundle\Document\Competition;

/**
 * Description of CompetitionRepository
 *
 * @author jobou
 */
class EventRepository extends DocumentRepository implements EventRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findAllPastNotProcessedEvent(\DateTime $date)
    {
        $qb = $this->createQueryBuilder()
            ->field('date')->lt($date)
            ->field('processed')->equals(false);

        return $qb->getQuery()->execute();
    }

    /**
     * {@inheritDoc}
     */
    public function findNextEvents(\DateTime $date, $limit = 30)
    {
        $qb = $this->createQueryBuilder()
            ->field('date')->gte($date)
            ->field('processed')->equals(false)
            ->sort('date', 'asc')
            ->limit($limit);

        return $qb->getQuery()->execute();
    }

    /**
     * {@inheritDoc}
     */
    public function getEventTeamNameChoices(Competition $competition)
    {
        $qb = $this->createQueryBuilder()
            ->select('leftName', 'rightName')
            ->field('competition.id')->equals($competition->getId())
            ->field('leftName')->exists(true)->notEqual(null)->notEqual('')
            ->field('rightName')->exists(true)->notEqual(null)->notEqual('');

        $result = $qb
            ->hydrate(false)
            ->getQuery()
            ->execute();

        $choices = array();
        foreach ($result as $item) {
            $choices[$item['left_name']] = $item['left_name'];
            $choices[$item['right_name']] = $item['right_name'];
        }

        asort($choices);

        return $choices;
    }

    /**
     * {@inheritDoc}
     */
    public function findAllOrderedEvent(Competition $competition)
    {
        $qb = $this->createQueryBuilder()
            ->field('competition.id')->equals($competition->getId())
            ->sort('date', 'asc');

        return $qb->getQuery()->execute();
    }
}
