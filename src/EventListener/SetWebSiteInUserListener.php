<?php

namespace App\EventListener;

use App\Entity\EntityInterface;
use App\Entity\User;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SetWebSiteInUserListener
{
    public function __construct(private readonly UrlGeneratorInterface $urlGenerator)
    {
    }

    /**
     * @param EntityInterface $entity
     */
    public function postLoad($entity): void
    {
        if (!$entity instanceof User) {
            return;
        }

        $webSite = $this->urlGenerator->generate('app_user_profile', ['slug' => $entity->getSlug()], UrlGeneratorInterface::ABSOLUTE_URL);

        $entity->setWebSite($webSite);
    }
}
