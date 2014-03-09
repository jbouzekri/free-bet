<?php

namespace BettingSas\Bundle\CompetitionBundle\Document\EventListener;

use Doctrine\ODM\MongoDB\Event\LoadClassMetadataEventArgs;

/**
 * Description of EventInheritanceListener
 *
 * @author jobou
 */
class EventInheritanceListener
{
    protected $mappingEvents;

    public function __construct(array $mappingEvents)
    {
        $this->mappingEvents = $mappingEvents;
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $classMetadata = $eventArgs->getClassMetadata();
        if ($classMetadata->getName() == 'BettingSas\\Bundle\\CompetitionBundle\\Document\\Event') {
            $classMetadata->setDiscriminatorMap($this->mappingEvents);
        }
    }
}