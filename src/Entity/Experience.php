<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\ExperienceRepository;
use App\ThirdCode\Contracts\ExperienceInterface;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'experience')]
#[ORM\Entity(repositoryClass: ExperienceRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class Experience implements ExperienceInterface, EntityInterface, HasUserInterface
{
    use HasUserTrait;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'experiences')]
    #[ORM\JoinColumn(name: 'user_id', nullable: false)]
    protected UserInterface $user;

    #[Assert\Length(max: 150)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING, length: 150)]
    protected string $title;

    #[Assert\Length(max: 50)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING, length: 50)]
    protected string $company;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $description = null;

    #[Assert\NotBlank]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected DateTimeInterface $periodStart;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?DateTimeInterface $periodEnd = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPeriodStart(): DateTimeInterface
    {
        return $this->periodStart;
    }

    public function setPeriodStart(DateTimeInterface $periodStart): self
    {
        $this->periodStart = $periodStart;

        return $this;
    }

    public function getPeriodEnd(): ?DateTimeInterface
    {
        return $this->periodEnd;
    }

    public function setPeriodEnd(?DateTimeInterface $periodEnd): self
    {
        $this->periodEnd = $periodEnd;

        return $this;
    }

    public function getDateStarted(): DateTimeInterface
    {
        return $this->getPeriodStart();
    }

    public function getDateFinished(): ?DateTimeInterface
    {
        return $this->getPeriodEnd();
    }
}
