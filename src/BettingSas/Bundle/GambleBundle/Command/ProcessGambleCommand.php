<?php

namespace BettingSas\Bundle\GambleBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use BettingSas\Bundle\CompetitionBundle\Document\Event;

/**
 * Description of ProcessGambleCommand
 *
 * @author jobou
 */
class ProcessGambleCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('gamble:process')
            ->setDescription('Process all events marked as finished and not processed to update gamble states')
        ;
    }

    /**
     * Command logic
     *
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $events = $this->getContainer()
            ->get('doctrine_mongodb')
            ->getManager()
            ->getRepository('BettingSasCompetitionBundle:Event')
            ->createQueryBuilder()
            ->field('date')->lt(new \DateTime())
            ->field('processed')->equals(false)
            ->getQuery()
            ->execute();

        foreach ($events as $event) {
            $this->processGambleWithBetsOnEvent($event);

            $this->getContainer()->get('doctrine_mongodb')->getManager()->clear('BettingSasGambleBundle:Gamble');
        }
    }

    protected function processGambleWithBetsOnEvent(Event $event)
    {
        // TODO : remove $id in field
        // use field('bets.event')->equals(\MongoDBRef::create("event", new \MongoId('4e63611cbc347053a2000001'),'database_name')) to ensure index use
        $gambles = $this->getContainer()
            ->get('doctrine_mongodb')
            ->getRepository('BettingSasGambleBundle:Gamble')
            ->createQueryBuilder()
            ->field('bets.event.$id')->equals(new \MongoId($event->getId()))
            ->getQuery()
            ->execute();

        if (count($gambles)) {
            foreach ($gambles as $gamble) {
                $this->getContainer()->get('betting_sas.gamble.processor')->processGambleWithEvent($gamble, $event);

                $this->getContainer()->get('doctrine_mongodb')->getManager()->persist($gamble);
                $this->getContainer()->get('doctrine_mongodb')->getManager()->flush();
            }
        }
    }
}