<?php

namespace App\Repository;

use App\Entity\EntityInterface;
use App\Entity\UserInterface;

interface OwnerDataRepositoryInterface
{
    /**
     * @return array<int, EntityInterface>
     */
    public function getOwnerData(UserInterface $user): array;
}
