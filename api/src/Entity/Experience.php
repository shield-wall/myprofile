<?php

declare(strict_types=1);

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
     * @Assert\Length(max="150")
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=150)
     *
     * @var string
     */
    protected $title;

    /**
     * @Assert\Length(max="50")
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     */
    protected $company;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     *
     * @var $description
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Experience
     */
    public function setUser(User $user): Experience
    {
        $this->user = $user;
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
     * @return Experience
     */
    public function setTitle(string $title): Experience
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return Experience
     */
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

    /**
     * @param DateTimeInterface $periodStart
     * @return Experience
     */
    public function setPeriodStart(DateTimeInterface $periodStart): Experience
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
     * @return Experience
     */
    public function setPeriodEnd(?DateTimeInterface $periodEnd): Experience
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }
}
