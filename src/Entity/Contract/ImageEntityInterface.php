<?php

namespace App\Entity\Contract;

interface ImageEntityInterface
{
    public function setImage(string $image): static;

    public function getImage(): string;
}
