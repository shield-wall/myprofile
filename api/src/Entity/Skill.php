<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="skill")
 * @ORM\Entity(repositoryClass="App\Repository\SkillRepository")
 * @ORM\EntityListeners({"App\EventListener\UpdateCurriculumListener"})
 */
class Skill
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="skills")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(name="name", type="string", length=50)
     */
    protected $name;

    /**
     * @var int
     * @Assert\Range(min = 0, max = 100)
     * @ORM\Column(name="level_experience", type="smallint")
     */
    protected $levelExperience;

    /**
     * @ORM\Column(name="priority", type="smallint", nullable=true)
     */
    protected $priority;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    protected $status = true;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Skill
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set levelExperience
     *
     * @param int $levelExperience
     *
     * @return Skill
     */
    public function setLevelExperience(int $levelExperience)
    {
        $this->levelExperience = $levelExperience;

        return $this;
    }

    /**
     * Get levelExperience
     *
     * @return int
     */
    public function getLevelExperience()
    {
        return $this->levelExperience;
    }

    /**
     * Set priority
     *
     * @param int $priority
     *
     * @return Skill
     */
    public function setPriority(int $priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set status
     *
     * @param bool $status
     *
     * @return Skill
     */
    public function setStatus(bool $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param User $user
     *
     * @return Skill
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
