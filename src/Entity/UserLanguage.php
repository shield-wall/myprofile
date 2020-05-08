<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserLanguageRepository")
 */
class UserLanguage
{
    public const LEVELS = [
        'BEGINNER' => 'Beginner',
        'ELEMENTARY' => 'Elementary',
        'PRE-INTERMEDIATE' => 'Pre-intermediate',
        'INTERMEDIATE' => 'Intermediate',
        'UPPER-INTERMEDIATE' => 'Upper-intermediate',
        'ADVANCE' => 'Advanced',
        'PROFICIENT/FLUENT' => 'Proficient / Fluent',
        'NATIVE' => 'Native',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50)
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userLanguages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    public function getId(): ?int
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

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
