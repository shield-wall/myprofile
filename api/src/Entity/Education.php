<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Table(name: 'education')]
#[ORM\Entity]
class Education implements EntityInterface, HasUserInterface
{
    use HasUserTrait;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'educations')]
    #[ORM\JoinColumn(name: 'user_id')]
    protected UserInterface $user;

    /**
     * @Assert\Length(max="200")
     * @Assert\NotBlank()
     *
     */
    #[ORM\Column(type: Types::STRING, length: 200)]
    protected string $title;

    /**
     * @Assert\Length(max="200")
     * @Assert\NotBlank()
     *
     */
    #[ORM\Column(type: Types::STRING, length: 200)]
    protected string $institution;

    /**
     * @Assert\NotBlank()
     *
     */
    #[ORM\Column(type: Types::TEXT)]
    protected string $description;

    /**
     * @Assert\NotBlank()
     *
     */
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    protected DateTimeInterface $periodStart;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?DateTimeInterface $periodEnd = null;

    /**
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     */
    public function setId(int $id): Education
    {
        $this->id = $id;
        return $this;
    }

    /**
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     */
    public function setTitle(string $title): Education
    {
        $this->title = $title;
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
    public function setInstitution(string $institution): Education
    {
        $this->institution = $institution;
        return $this;
    }

    /**
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     */
    public function setDescription(string $description): Education
    {
        $this->description = $description;
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
    public function setPeriodStart(DateTimeInterface $periodStart): Education
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
    public function setPeriodEnd(?DateTimeInterface $periodEnd): Education
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }
}
