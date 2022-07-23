<?php

namespace App\Repository;

use App\Entity\UserInterface;
use App\Entity\UserLanguage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserInterface[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 */
class UserLanguageRepository extends ServiceEntityRepository implements OwnerDataRepositoryInterface
{
    use OwnerDataTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserLanguage::class);
    }
}
