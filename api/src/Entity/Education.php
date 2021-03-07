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
     * @Assert\Length(max="200")
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=200)
     *
     * @var string
     */
    protected $title;

    /**
     * @Assert\Length(max="200")
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=200)
     *
     * @var string
     */
    protected $institution;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     *
     * @var string
     */
    protected $description;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="date")
     *
     * @var DateTimeInterface
     */
    protected $periodStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @var DateTimeInterface|null
     */
    protected $periodEnd;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Education
     */
    public function setId(int $id): Education
    {
        $this->id = $id;
        return $this;
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
     * @return Education
     */
    public function setTitle(string $title): Education
    {
        $this->title = $title;
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
     * @return Education
     */
    public function setInstitution(string $institution): Education
    {
        $this->institution = $institution;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Education
     */
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

    /**
     * @param DateTimeInterface $periodStart
     * @return Education
     */
    public function setPeriodStart(DateTimeInterface $periodStart): Education
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
     * @return Education
     */
    public function setPeriodEnd(?DateTimeInterface $periodEnd): Education
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }
}
