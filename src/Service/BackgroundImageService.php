<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use transloadit\Transloadit;

class BackgroundImageService
{
    /**
     * @TODO pass all parameters as string and remove ParameterBagInterface
     *      TODO 2 -> please provide some solution to use the same code of ProfileImageService
     */
    public function __construct(
        private readonly Transloadit $transloadit,
        private readonly ParameterBagInterface $params,
        private readonly string $cdnHostWithPrefix,
        private readonly string $bucketHostWithPrefix,
    ) {
    }

    public function upload(User $user, ?UploadedFile $file): void
    {
        if (!$this->params->get('transloadit.delivery')) {
            return;
        }

        if (null == $file) {
            return;
        }

        $path = str_replace([$this->cdnHostWithPrefix, $this->bucketHostWithPrefix], '', $user->getBackgroundImage());

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
                        'url_prefix' => $this->cdnHostWithPrefix . '/',
                        'path' => $path,
                    ],
                ],
            ],
        ]);

        unlink($fileFullPath);
    }
}
