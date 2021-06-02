<?php

namespace App\Entity;

trait HasUserTrait
{
    protected $user;

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
