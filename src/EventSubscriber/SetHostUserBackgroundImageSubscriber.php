<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class SetHostUserBackgroundImageSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly string $cdnHostWithPrefix)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postLoad,
        ];
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $object = $args->getObject();

        if (!$object instanceof User) {
            return;
        }

        $absoluteImagePath = sprintf('%s%s', $this->cdnHostWithPrefix, $object->getBackgroundImage());
        $object->setBackgroundImage($absoluteImagePath);
    }
}
