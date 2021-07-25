<?php

declare(strict_types=1);

namespace App\Entity;

trait HasUserTrait
{
    protected UserInterface $user;

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }
}
