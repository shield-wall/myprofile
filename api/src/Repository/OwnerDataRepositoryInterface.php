<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserInterface;

interface OwnerDataRepositoryInterface
{
    /**
     * @return array<UserInterface>
     */
    public function getOwnerData(UserInterface $user): array;
}
