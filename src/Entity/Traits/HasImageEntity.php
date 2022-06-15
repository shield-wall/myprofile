<?php

namespace App\Entity\Traits;

trait HasImageEntity
{
    private string $image;

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}
