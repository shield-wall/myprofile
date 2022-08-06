<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\EducationRepository;
use App\ThirdCode\Contracts\EducationInterface;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'education')]
#[ORM\Entity(repositoryClass: EducationRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class Education implements EntityInterface, HasUserInterface, EducationInterface
{
    use HasUserTrait;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'educations')]
    #[ORM\JoinColumn(name: 'user_id', nullable: false)]
    protected UserInterface $user;

    #[Assert\Length(max: 200)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING, length: 200)]
    protected string $title;

    #[Assert\Length(max: 200)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING, length: 200)]
    protected string $institution;

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

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getInstitution(): string
    {
        return $this->institution;
    }

    public function setInstitution(string $institution): self
    {
        $this->institution = $institution;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
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
