<?php


namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\User;
use transloadit\Transloadit;

class CurriculumService
{
    private $router;
    private $transloadit;
    private $params;

    public function __construct(
        Transloadit $transloadit,
        UrlGeneratorInterface $router,
        ParameterBagInterface $params
    )
    {
        $this->router = $router;
        $this->transloadit = $transloadit;
        $this->params = $params;
    }

    public function makePdfOnTransloadit($user)
    {
        if (!$this->params->get('transloadit.delivery'))
            return;

        $url_prefix = sprintf('%s/%s/', $this->params->get('cdn.dns'), $this->params->get('bucket.name'));

        $this->transloadit->createAssembly([
            'params' => [
                'template_id' => $this->params->get('transloadit.template_id'),
                "steps" => [
                    "screenshot_en" => [
                        "url" => $this->getAbsoluteUrl($user, 'en'),
                    ],
                    "screenshot_pt_BR" => [
                        "url" => $this->getAbsoluteUrl($user, 'pt_BR'),
                    ],
                    'store' => [
                        'credentials' => $this->params->get('transloadit.credentials'),
                        'url_prefix' => $url_prefix,
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
            ['username' => $user, '_locale' => $locale],
            UrlGeneratorInterface::ABSOLUTE_URL
        );
    }
}