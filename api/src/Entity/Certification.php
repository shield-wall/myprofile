<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * Certification
 *
 * @ORM\Table(name="certification")
 * @ORM\Entity
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
     */
    protected int $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="certifications")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    protected UserInterface $user;

    /**
     * @Assert\Length(max="100")
     * @ORM\Column(name="title", type="string", length=100)
     *
     */
    protected string $title;

    /**
     * @ORM\Column(name="period_start", type="date")
     *
     */
    protected DateTimeInterface $periodStart;

    /**
     *
     * @ORM\Column(name="period_end", type="date", nullable=true)
     */
    protected ?DateTimeInterface $periodEnd = null;

    /**
     * @Assert\Length(max="100")
     * @ORM\Column(name="institution", type="string", length=100)
     *
     */
    protected string $institution;

    /**
     * @Assert\Length(max="500")
     * @ORM\Column(name="link", type="string", length=500, nullable=true)
     *
     */
    protected ?string $link = null;

    /**
     * @Assert\Length(max="255")
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     *
     */
    protected ?string $image = null;

    /**
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     */
    public function setTitle(string $title): Certification
    {
        $this->title = $title;
        return $this;
    }

    /**
     */
    public function getPeriodStart(): ?DateTimeInterface
    {
        return $this->periodStart;
    }

    /**
     */
    public function setPeriodStart(DateTimeInterface $periodStart): Certification
    {
        $this->periodStart = $periodStart;
        return $this;
    }

    /**
     */
    public function getPeriodEnd(): ?DateTimeInterface
    {
        return $this->periodEnd;
    }

    /**
     */
    public function setPeriodEnd(?DateTimeInterface $periodEnd): Certification
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }

    /**
     */
    public function getInstitution(): string
    {
        return $this->institution;
    }

    /**
     */
    public function setInstitution(string $institution): Certification
    {
        $this->institution = $institution;
        return $this;
    }

    /**
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     */
    public function setLink(?string $link): Certification
    {
        $this->link = $link;
        return $this;
    }

    /**
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     */
    public function setImage(?string $image): Certification
    {
        $this->image = $image;
        return $this;
    }
}
