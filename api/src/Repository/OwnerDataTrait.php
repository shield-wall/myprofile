<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\UserInterface;

trait OwnerDataTrait
{
    /**
     * @return array<UserInterface>
     */
    public function getOwnerData(UserInterface $user): array
    {
        return $this->findBy(['user' => $user->getId()]);
    }
}
