<?php

namespace AppBundle\Listener;

use AppBundle\Model\Clock;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class TimestampListener
{
    /**
     * @var Clock
     */
    private $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function prePersist(LifecycleEventArgs $lifecycleEventArgs)
    {
        $entity = $lifecycleEventArgs->getEntity();

        if (method_exists($entity, 'setCreatedAt')) {
            $entity->setCreatedAt(
                $this->clock->now()
            );
        }
    }

    public function preUpdate(PreUpdateEventArgs $preUpdateEventArgs)
    {
        $entity = $preUpdateEventArgs->getEntity();

        if (method_exists($entity, 'setUpdatedAt')) {
            $entity->setCreatedAt(
                $this->clock->now()
            );
        }
    }
}