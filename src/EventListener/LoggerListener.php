<?php

namespace App\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;

/**
 *
 */
class LoggerListener
{

    function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        //we do nothing if entity is not user instance
        if (!$entity instanceof User) {
          return;
        }

        $this->logger->info('User '. $entity->getId().' has been changed.');
    }
}
