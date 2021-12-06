<?php

declare(strict_types=1);

namespace App\Entity;

interface HasUserInterface
{
    public function getUser(): UserInterface;

    public function setUser(UserInterface $user): self;
}
