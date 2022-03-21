<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * Certification
 *
 * @ORM\Table(name="certification")
 * @ORM\Entity(repositoryClass="App\Repository\CertificationRepository")
 * @ORM\EntityListeners({"App\EventListener\UpdateCurriculumListener"})
 */
class Certification implements
    EntityInterface,
    HasUserInterface
{
    use HasUserTrait;

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="certifications")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * @ORM\Column(name="title", type="string", length=100)
     */
    #[Assert\Length(max: 100)]
    private string $title;

    /**
     * @ORM\Column(name="period_start", type="date")
     */
    private \DateTimeInterface $periodStart;

    /**
     * @ORM\Column(name="period_end", type="date", nullable=true)
     */
    private ?\DateTimeInterface $periodEnd = null;

    /**
     * @ORM\Column(name="institution", type="string", length=100)
     */
    #[Assert\Length(max: 100)]
    private string $institution;

    /**
     * @ORM\Column(name="link", type="string", length=500, nullable=true)
     */
    #[Assert\Length(max: 500)]
    private ?string $link = null;

    /**
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    #[Assert\Length(max: 255)]
    private ?string $image = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Certification
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

    public function setPeriodStart(DateTimeInterface $periodStart): Certification
    {
        $this->periodStart = $periodStart;
        return $this;
    }

    public function getPeriodEnd(): ?DateTimeInterface
    {
        return $this->periodEnd;
    }

    public function setPeriodEnd(?DateTimeInterface $periodEnd): Certification
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }

    public function getInstitution(): string
    {
        return $this->institution;
    }

    public function setInstitution(string $institution): Certification
    {
        $this->institution = $institution;
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): Certification
    {
        $this->link = $link;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): Certification
    {
        $this->image = $image;
        return $this;
    }
}
