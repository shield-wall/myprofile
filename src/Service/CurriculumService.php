<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\User;
use transloadit\Transloadit;

class CurriculumService
{
    public function __construct(private readonly Transloadit $transloadit, private readonly UrlGeneratorInterface $router, private readonly ParameterBagInterface $params)
    {
    }

    public function makePdfOnTransloadit($user)
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

    private function getAbsoluteUrl($user, $locale)
    {
        return $this->router->generate(
            'app_curriculum',
            ['slug' => $user->getSlug(), '_locale' => $locale],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
    }
}
