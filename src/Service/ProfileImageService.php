<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use transloadit\Transloadit;

class ProfileImageService
{
    /**
     * @TODO pass all parameters as string and remove ParameterBagInterface
     */
    public function __construct(
        private readonly Transloadit $transloadit,
        private readonly ParameterBagInterface $params,
        private readonly string $cdnHostWithPrefix,
        private readonly string $bucketHostWithPrefix,
    ) {
    }

    public function upload($user, $file)
    {
        if (!$this->params->get('transloadit.delivery')) {
            return;
        }

        if (null == $file) {
            return;
        }

        $file->move($this->params->get('transloadit.tmp'), $file->getClientOriginalName());
        $fileFullPath = sprintf('%s/%s', $this->params->get('transloadit.tmp'), $file->getClientOriginalName());

        $path = str_replace([$this->cdnHostWithPrefix, $this->bucketHostWithPrefix], '', $user->getProfileImage());

        $this->transloadit->createAssembly([
            'files' => [
                $fileFullPath,
            ],
            'params' => [
                'template_id' => $this->params->get('transloadit.template_id.image.profile'),
                'steps' => [
                    'export' => [
                        'credentials' => $this->params->get('transloadit.credentials'),
                        'url_prefix' => $this->cdnHostWithPrefix . '/',
                        'path' => $path,
                    ],
                ],
            ],
        ]);

        $this->removeFile($fileFullPath);
    }

    protected function removeFile($fileFullPath): void
    {
        unlink($fileFullPath);
    }
}
