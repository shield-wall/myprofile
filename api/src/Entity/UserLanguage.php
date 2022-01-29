<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class UserLanguage implements EntityInterface, HasUserInterface
{
    final public const LEVELS = [
        'BEGINNER' => 'Beginner',
        'ELEMENTARY' => 'Elementary',
        'PRE-INTERMEDIATE' => 'Pre-intermediate',
        'INTERMEDIATE' => 'Intermediate',
        'UPPER-INTERMEDIATE' => 'Upper-intermediate',
        'ADVANCE' => 'Advanced',
        'PROFICIENT/FLUENT' => 'Proficient / Fluent',
        'NATIVE' => 'Native',
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    /**
     * @Assert\Length(max="50")
     */
    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $name;

    /**
     * @Assert\Length(max="50")
     */
    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $level;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'userLanguages')]
    #[ORM\JoinColumn(nullable: false)]
    private UserInterface $user;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function getLevelName(): ?string
    {
        return self::LEVELS[$this->getLevel()];
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

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
