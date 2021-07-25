<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use transloadit\Transloadit;

class ProfileImageService
{
    private $router;
    private $transloadit;
    private $params;

    public function __construct(
        Transloadit $transloadit,
        UrlGeneratorInterface $router,
        ParameterBagInterface $params
    ) {
        $this->router = $router;
        $this->transloadit = $transloadit;
        $this->params = $params;
    }

    public function upload($user, $file)
    {
        if (!$this->params->get('transloadit.delivery')) {
            return;
        }

        if (null == $file) {
            return;
        }

        $urlPrefix = sprintf('%s/%s/', $this->params->get('cdn.dns'), $this->params->get('bucket.name'));

        $file->move($this->params->get('transloadit.tmp'), $file->getClientOriginalName());
        $fileFullPath = sprintf('%s/%s', $this->params->get('transloadit.tmp'), $file->getClientOriginalName());

        $this->transloadit->createAssembly([
            'files' => [
                $fileFullPath,
            ],
            'params' => [
                'template_id' => $this->params->get('transloadit.template_id.image.profile'),
                "steps" => [
                    'export' => [
                        'credentials' => $this->params->get('transloadit.credentials'),
                        'url_prefix' => $urlPrefix,
                        'path' => $user->getProfileImage(),
                    ],
                ],
            ],
        ]);

        unlink($fileFullPath);
    }
}
