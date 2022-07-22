<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use transloadit\Transloadit;

class CurriculumService
{
    public function __construct(
        private readonly Transloadit $transloadit,
        private readonly UrlGeneratorInterface $router,
        private readonly ParameterBagInterface $params
    ) {
    }

    public function makePdfOnTransloadit(User $user): void
    {
        if (!$this->params->get('transloadit.delivery')) {
            return;
        }

        /**
         * TODO inject those variables in __construct using symfony bind.
         * @var string $cdnDns
         */
        $cdnDns = $this->params->get('cdn.dns');

        /** @var string $bucketName */
        $bucketName = $this->params->get('bucket.name');

        $urlPrefix = sprintf('%s/%s/', $cdnDns, $bucketName);

        $this->transloadit->createAssembly([
            'params' => [
                'template_id' => $this->params->get('transloadit.template_id.curriculum'),
                'steps' => [
                    'screenshot_en' => [
                        'url' => $this->getAbsoluteUrl($user, 'en'),
                    ],
                    'screenshot_pt_BR' => [
                        'url' => $this->getAbsoluteUrl($user, 'pt_BR'),
                    ],
                    'store' => [
                        'credentials' => $this->params->get('transloadit.credentials'),
                        'url_prefix' => $urlPrefix,
                        'path' => sprintf('%s${file.name}', $user->getCurriculumPath()),
                    ],
                ],
            ],
        ]);
    }

    private function getAbsoluteUrl(User $user, string $locale): string
    {
        return $this->router->generate(
            'app_curriculum',
            ['slug' => $user->getSlug(), '_locale' => $locale],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
    }
}
