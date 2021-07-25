<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Repository\UserRepository;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

class SitemapSubscriber implements EventSubscriberInterface
{
    /**
     * @param array<string> $locales
     */
    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        private UserRepository $userRepository,
        private array $locales
    ) {
    }

    public function populate(SitemapPopulateEvent $event): void
    {
        $this->registerUsersUrls($event->getUrlContainer());
        $this->registerStaticUrls($event->getUrlContainer());
    }

    public function registerUsersUrls(UrlContainerInterface $urls): void
    {
        $users = $this->userRepository->findBy(['isVerified' => true]);

        foreach ($users as $user) {
            foreach ($this->locales as $locale) {
                $urls->addUrl(
                    new UrlConcrete(
                        $this->urlGenerator->generate(
                            'app_user_profile',
                            ['slug' => $user->getSlug(), '_locale' => $locale],
                            UrlGeneratorInterface::ABSOLUTE_URL
                        )
                    ),
                    "profile_$locale"
                );
            }
        }
    }

    public function registerStaticUrls(UrlContainerInterface $urls): void
    {
        $staticRouters = [
            'app_homepage',
            'app_register',
            'app_login',
        ];

        foreach ($staticRouters as $staticRouter) {
            foreach ($this->locales as $locale) {
                $urls->addUrl(
                    new UrlConcrete(
                        $this->urlGenerator->generate(
                            $staticRouter,
                            ['_locale' => $locale],
                            UrlGeneratorInterface::ABSOLUTE_URL
                        )
                    ),
                    "static_$locale"
                );
            }
        }
    }

    /**
     * @return array<string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'populate',
        ];
    }
}
