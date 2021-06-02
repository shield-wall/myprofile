<?php

namespace App\Repository;

use App\Entity\UserInterface;

interface OwnerDataRepositoryInterface
{
    public function getOwnerData(UserInterface $user): array;
}
