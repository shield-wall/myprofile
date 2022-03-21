<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\EventListener\UpdateCurriculumListener;
use App\Repository\ExperienceRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'experience')]
#[ORM\Entity(repositoryClass: ExperienceRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class Experience
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected ?int $id = null;
    /**
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'experiences')]
    #[ORM\JoinColumn(name: 'user_id')]
    protected $user;
    /**
     * @var string
     */
    #[Assert\Length(max: 150)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING, length: 150)]
    protected ?string $title = null;
    /**
     * @var string
     */
    #[Assert\Length(max: 50)]
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::STRING, length: 50)]
    protected ?string $company = null;
    /**
     * @var $description
     */
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::TEXT)]
    protected ?string $description = null;
    /**
     * @var DateTimeInterface
     */
    #[Assert\NotBlank]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected ?\DateTimeInterface $periodStart = null;
    /**
     * @var DateTimeInterface|null
     */
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?\DateTimeInterface $periodEnd = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

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

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     *
     * @return Experience
     */
    public function setDescription($description)
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
