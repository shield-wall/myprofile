<?php

namespace App\Entity;

trait HasUserTrait
{
    protected UserInterface $user;

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): static
    {
        $this->user = $user;

        return $this;
    }
}
