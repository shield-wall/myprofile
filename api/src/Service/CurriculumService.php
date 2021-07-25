<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use transloadit\Transloadit;

class CurriculumService
{
    private Transloadit $transloadit;
    private UrlGeneratorInterface $router;
    private ParameterBagInterface $params;

    public function __construct(
        Transloadit $transloadit,
        UrlGeneratorInterface $router,
        ParameterBagInterface $params
    ) {
        $this->router = $router;
        $this->transloadit = $transloadit;
        $this->params = $params;
    }

    public function makePdfOnTransloadit(User $user): void
    {
        if (!$this->params->get('transloadit.delivery')) {
            return;
        }

        $urlPrefix = sprintf('%s/%s/', $this->params->get('cdn.dns'), $this->params->get('bucket.name'));

        $this->transloadit->createAssembly([
            'params' => [
                'template_id' => $this->params->get('transloadit.template_id.curriculum'),
                "steps" => [
                    "screenshot_en" => [
                        "url" => $this->getAbsoluteUrl($user, 'en'),
                    ],
                    "screenshot_pt_BR" => [
                        "url" => $this->getAbsoluteUrl($user, 'pt_BR'),
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
