<?php

namespace App\Controller\Admin;

use App\Controller\AbstractCrudController as BaseAbstractCrudController;
use App\Repository\OwnerDataRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractCrudController extends BaseAbstractCrudController
{
    public const AREA = 'admin';

    public function index(OwnerDataRepositoryInterface $repository): Response
    {
        return $this->render(sprintf('%s/%s.html.twig', static::AREA, static::PREFIX), array(
            'data' => $repository->findAll(),
        ));
    }
}
