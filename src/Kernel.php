<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getCacheDir(): string
    {
        return '/tmp/var/' . $this->environment . '/cache';
    }

    public function getLogDir(): string
    {
        return '/tmp/var/' . $this->environment . '/log';
    }
}
