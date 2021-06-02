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
     *
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="certifications")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * @Assert\Length(max="100")
     * @ORM\Column(name="title", type="string", length=100)
     *
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(name="period_start", type="date")
     *
     * @var DateTimeInterface
     */
    private $periodStart;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(name="period_end", type="date", nullable=true)
     */
    private $periodEnd;

    /**
     * @Assert\Length(max="100")
     * @ORM\Column(name="institution", type="string", length=100)
     *
     * @var string
     */
    private $institution;

    /**
     * @Assert\Length(max="500")
     * @ORM\Column(name="link", type="string", length=500, nullable=true)
     *
     * @var string|null
     */
    private $link;

    /**
     * @Assert\Length(max="255")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     *
     * @var string|null
     */
    private $image;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Certification
     */
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

    /**
     * @param DateTimeInterface $periodStart
     * @return Certification
     */
    public function setPeriodStart(DateTimeInterface $periodStart): Certification
    {
        $this->periodStart = $periodStart;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getPeriodEnd(): ?DateTimeInterface
    {
        return $this->periodEnd;
    }

    /**
     * @param DateTimeInterface|null $periodEnd
     * @return Certification
     */
    public function setPeriodEnd(?DateTimeInterface $periodEnd): Certification
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstitution(): string
    {
        return $this->institution;
    }

    /**
     * @param string $institution
     * @return Certification
     */
    public function setInstitution(string $institution): Certification
    {
        $this->institution = $institution;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return Certification
     */
    public function setLink(?string $link): Certification
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return Certification
     */
    public function setImage(?string $image): Certification
    {
        $this->image = $image;
        return $this;
    }
}
