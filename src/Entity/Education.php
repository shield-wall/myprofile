<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * @ORM\Table(name="education")
 * @ORM\Entity(repositoryClass="App\Repository\EducationRepository")
 * @ORM\EntityListeners({"App\EventListener\UpdateCurriculumListener"})
 */
class Education implements
    EntityInterface,
    HasUserInterface
{
    use HasUserTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="educations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=200)
     *
     * @var string
     */
    #[Assert\Length(max: 200)]
    #[Assert\NotBlank]
    protected $title;

    /**
     * @ORM\Column(type="string", length=200)
     *
     * @var string
     */
    #[Assert\Length(max: 200)]
    #[Assert\NotBlank]
    protected $institution;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    #[Assert\NotBlank]
    protected $description;

    /**
     * @ORM\Column(type="date")
     * @var DateTimeInterface
     */
    #[Assert\NotBlank]
    protected $periodStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var DateTimeInterface|null
     */
    protected $periodEnd;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Education
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Education
    {
        $this->title = $title;
        return $this;
    }

    public function getInstitution(): string
    {
        return $this->institution;
    }

    public function setInstitution(string $institution): Education
    {
        $this->institution = $institution;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Education
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

    public function setPeriodStart(DateTimeInterface $periodStart): Education
    {
        $this->periodStart = $periodStart;
        return $this;
    }

    public function getPeriodEnd(): ?DateTimeInterface
    {
        return $this->periodEnd;
    }

    public function setPeriodEnd(?DateTimeInterface $periodEnd): Education
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }
}
