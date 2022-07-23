<?php

namespace App\Repository;

use App\Entity\UserInterface;

trait OwnerDataTrait
{
    /**
     * @return UserInterface[]
     */
    public function getOwnerData(UserInterface $user): array
    {
        return $this->findBy(['user' => $user->getId()]);
    }
}
