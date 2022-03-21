<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use transloadit\Transloadit;

class BackgroundImageService
{
    public function __construct(private readonly Transloadit $transloadit, private readonly ParameterBagInterface $params)
    {
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
                'template_id' => $this->params->get('transloadit.template_id.image.background'),
                'steps' => [
                    'export' => [
                        'credentials' => $this->params->get('transloadit.credentials'),
                        'url_prefix' => $urlPrefix,
                        'path' => $user->getBackgroundImage(),
                    ],
                ],
            ],
        ]);

        unlink($fileFullPath);
    }
}
