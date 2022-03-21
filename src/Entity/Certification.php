<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\CertificationRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Certification.
 */
#[ORM\Table(name: 'certification')]
#[ORM\Entity(repositoryClass: CertificationRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class Certification implements EntityInterface, HasUserInterface
{
    use HasUserTrait;
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private readonly int $id;
    /**
     * @var UserInterface
     */
    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'certifications')]
    #[ORM\JoinColumn(name: 'user_id')]
    protected $user;
    #[Assert\Length(max: 100)]
    #[ORM\Column(name: 'title', type: Types::STRING, length: 100)]
    private string $title;
    #[ORM\Column(name: 'period_start', type: Types::DATE_MUTABLE)]
    private \DateTimeInterface $periodStart;
    #[ORM\Column(name: 'period_end', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $periodEnd = null;
    #[Assert\Length(max: 100)]
    #[ORM\Column(name: 'institution', type: Types::STRING, length: 100)]
    private string $institution;
    #[Assert\Length(max: 500)]
    #[ORM\Column(name: 'link', type: Types::STRING, length: 500, nullable: true)]
    private ?string $link = null;
    #[Assert\Length(max: 255)]
    #[ORM\Column(name: 'image', type: Types::STRING, length: 255, nullable: true)]
    private ?string $image = null;

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

    public function getInstitution(): string
    {
        return $this->institution;
    }

    public function setInstitution(string $institution): self
    {
        $this->institution = $institution;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
