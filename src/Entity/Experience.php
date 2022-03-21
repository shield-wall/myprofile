<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 * @ORM\EntityListeners({"App\EventListener\UpdateCurriculumListener"})
 */
class Experience
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="experiences")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var User
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=150)
     *
     * @var string
     */
    #[Assert\Length(max: 150)]
    #[Assert\NotBlank]
    protected $title;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     */
    #[Assert\Length(max: 50)]
    #[Assert\NotBlank]
    protected $company;

    /**
     * @ORM\Column(type="text")
     * @var $description
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

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): Experience
    {
        $this->user = $user;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Experience
    {
        $this->title = $title;
        return $this;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function setCompany(string $company): Experience
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

    public function setPeriodStart(DateTimeInterface $periodStart): Experience
    {
        $this->periodStart = $periodStart;
        return $this;
    }

    public function getPeriodEnd(): ?DateTimeInterface
    {
        return $this->periodEnd;
    }

    public function setPeriodEnd(?DateTimeInterface $periodEnd): Experience
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }
}
