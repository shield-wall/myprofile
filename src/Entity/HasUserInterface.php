<?php

namespace App\Entity;

interface HasUserInterface
{
    public function getUser(): UserInterface;

    public function setUser(UserInterface $user);
}
