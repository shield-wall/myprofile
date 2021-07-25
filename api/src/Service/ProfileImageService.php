<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\File;
use transloadit\Transloadit;

class ProfileImageService
{
    private Transloadit $transloadit;
    private ParameterBagInterface $params;

    public function __construct(Transloadit $transloadit, ParameterBagInterface $params)
    {
        $this->transloadit = $transloadit;
        $this->params = $params;
    }

    public function upload(User $user, File $file): void
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
