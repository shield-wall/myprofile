<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\EducationRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'education')]
#[ORM\Entity(repositoryClass: EducationRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class Education implements EntityInterface, HasUserInterface
{
    use HasUserTrait;
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected $id;
    /**
     * @var UserInterface
     */
    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'educations')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    protected $user;
    /**
     * @var string
     */
    #[Assert\Length(max: 200)]
    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 200)]
    protected $title;
    /**
     * @var string
     */
    #[Assert\Length(max: 200)]
    #[Assert\NotBlank]
    #[ORM\Column(type: 'string', length: 200)]
    protected $institution;
    /**
     * @var string
     */
    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    protected $description;
    /**
     * @var DateTimeInterface
     */
    #[Assert\NotBlank]
    #[ORM\Column(type: 'date')]
    protected $periodStart;
    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: 'date', nullable: true)]
    protected $periodEnd;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getPeriodStart(): ?DateTimeInterface
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
}
