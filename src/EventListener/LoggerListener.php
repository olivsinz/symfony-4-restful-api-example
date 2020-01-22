<?php

namespace App\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Psr\Log\LoggerInterface;
use App\Entity\User;


/**
 *
 */
class LoggerListener
{

    function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        //we do nothing if entity is not user instance
        if (!$entity instanceof User) {
          return;
        }

        // we report in the logs that user with $entity->getId() has changed
        $this->logger->info('User '. $entity->getId().' has been changed.');
    }
}
