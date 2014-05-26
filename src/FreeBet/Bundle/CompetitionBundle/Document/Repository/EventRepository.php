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
    public function findAllEndedAndNotProcessedEvent()
    {
        $qb = $this->createQueryBuilder()
            ->field('date')->lt(new \DateTime())
            ->field('processed')->equals(false);

        return $qb->getQuery()->execute();
    }

    /**
     * {@inheritDoc}
     */
    public function findNextEvents($limit = 30)
    {
        $qb = $this->createQueryBuilder()
            ->field('date')->gte(new \DateTime())
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
}
