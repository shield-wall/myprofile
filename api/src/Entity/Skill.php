<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 */
class Skill
{
    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="skills")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected UserInterface $user;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(name="name", type="string", length=50)
     */
    protected string $name;

    /**
     * @Assert\Range(min = 0, max = 100)
     * @ORM\Column(name="level_experience", type="smallint")
     */
    protected int $levelExperience;

    /**
     * @ORM\Column(name="priority", type="smallint", nullable=true)
     */
    protected int $priority;

    /**
     *
     * @ORM\Column(name="status", type="boolean")
     */
    protected bool $status = true;


    /**
     * Get id
     *
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     *
     */
    public function setName(string $name): Skill
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set levelExperience
     *
     *
     */
    public function setLevelExperience(int $levelExperience): Skill
    {
        $this->levelExperience = $levelExperience;

        return $this;
    }

    /**
     * Get levelExperience
     *
     */
    public function getLevelExperience(): int
    {
        return $this->levelExperience;
    }

    /**
     * Set priority
     *
     *
     */
    public function setPriority(int $priority): Skill
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * Set status
     *
     *
     */
    public function setStatus(bool $status): Skill
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     *
     */
    public function setUser(User $user): Skill
    {
        $this->user = $user;

        return $this;
    }

    /**
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
