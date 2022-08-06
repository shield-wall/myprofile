<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\SkillRepository;
use App\ThirdCode\Contracts\SkillInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'skill')]
#[ORM\Entity(repositoryClass: SkillRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class Skill implements SkillInterface, EntityInterface, HasUserInterface
{
    use HasUserTrait;

    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'skills')]
    #[ORM\JoinColumn(name: 'user_id', nullable: false)]
    protected UserInterface $user;

    #[Assert\Length(max: 50)]
    #[ORM\Column(name: 'name', type: Types::STRING, length: 50)]
    private string $name;

    #[Assert\Range(min: 0, max: 100)]
    #[ORM\Column(name: 'level_experience', type: Types::SMALLINT)]
    private int $levelExperience;

    #[ORM\Column(name: 'priority', type: Types::SMALLINT, nullable: true)]
    private ?int $priority = null;

    #[ORM\Column(name: 'status', type: Types::BOOLEAN)]
    private bool $status = true;

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setLevelExperience(int $levelExperience): static
    {
        $this->levelExperience = $levelExperience;

        return $this;
    }

    public function getLevelExperience(): int
    {
        return $this->levelExperience;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getStatus(): bool
    {
        return $this->status;
    }

    public function getTitle(): string
    {
        return $this->getName();
    }
}
