<?php

namespace App\Entity;

trait HasUserTrait
{
    protected ?UserInterface $user = null;

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }
}
