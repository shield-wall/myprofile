<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\UserInterface;
use App\ThirdCode\Contracts\Repository\EmailRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User[] findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 * @method UserInterface findOneBy(array $criteria, ?array $orderBy = null)
 */
class UserRepository extends ServiceEntityRepository implements EmailRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function create(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    public function findOneByEmail(string $email): UserInterface
    {
        return $this->findOneBy(['email' => $email]);
    }
}
