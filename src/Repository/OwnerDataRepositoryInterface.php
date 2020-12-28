<?php

namespace App\Repository;

use App\Entity\UserInterface;

/**
 * Interface OwnerDataRepositoryInterface
 * @package App\Repository
 * @method findAll
 */
interface OwnerDataRepositoryInterface
{
    public function getOwnerData(UserInterface $user): array;
}
