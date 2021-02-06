<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

interface UserInterface extends BaseUserInterface
{
    public function getId(): int;

    public function getEmail(): string;
}
