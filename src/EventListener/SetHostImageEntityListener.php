<?php

namespace App\EventListener;

use App\Entity\Contract\ImageEntityInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class SetHostImageEntityListener
{
    public function __construct(private readonly string $cdnHostWithPrefix)
    {
    }

    public function postLoad(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof ImageEntityInterface) {
            return;
        }

        $absoluteImagePath = sprintf('%s%s', $this->cdnHostWithPrefix, $entity->getImage());
        $entity->setImage($absoluteImagePath);
    }
}
