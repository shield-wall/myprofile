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

        /**
         * TODO inject this variable in construct using symfony bind.
         *
         * @var string $transloaditTmp
         */
        $transloaditTmp = $this->params->get('transloadit.tmp');
        /** @var string $transloaditBackground */
        $transloaditBackground = $this->params->get('transloadit.template_id.image.background');
        /** @var string $transloaditCredentials */
        $transloaditCredentials = $this->params->get('transloadit.credentials');

        $file->move($transloaditTmp, $file->getClientOriginalName());
        $fileFullPath = sprintf('%s/%s', $transloaditTmp, $file->getClientOriginalName());

        $this->transloadit->createAssembly([
            'files' => [
                $fileFullPath,
            ],
            'params' => [
                'template_id' => $transloaditBackground,
                'steps' => [
                    'export' => [
                        'credentials' => $transloaditCredentials,
                        'url_prefix' => $this->cdnHostWithPrefix . '/',
                        'path' => $path,
                    ],
                ],
            ],
        ]);

        unlink($fileFullPath);
    }
}
