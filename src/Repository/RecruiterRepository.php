<?php

namespace App\Repository;

use App\Entity\Recruiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class RecruiterRepository extends ServiceEntityRepository implements OwnerDataRepositoryInterface
{
    use OwnerDataTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recruiter::class);
    }
}
