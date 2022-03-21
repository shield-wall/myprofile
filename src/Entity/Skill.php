<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'skill')]
#[ORM\Entity(repositoryClass: SkillRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class Skill
{
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private readonly int $id;
    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'skills')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id')]
    protected $user;
    #[Assert\Length(max: 50)]
    #[ORM\Column(name: 'name', type: 'string', length: 50)]
    private $name;
    #[Assert\Range(min: 0, max: 100)]
    #[ORM\Column(name: 'level_experience', type: 'smallint')]
    private int $levelExperience;
    #[ORM\Column(name: 'priority', type: 'smallint', nullable: true)]
    private $priority;
    #[ORM\Column(name: 'status', type: 'boolean')]
    private bool $status = true;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @return Skill
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set levelExperience.
     *
     * @return Skill
     */
    public function setLevelExperience(int $levelExperience)
    {
        $this->levelExperience = $levelExperience;

        return $this;
    }

    /**
     * Get levelExperience.
     *
     * @return int
     */
    public function getLevelExperience()
    {
        return $this->levelExperience;
    }

    /**
     * Set priority.
     *
     * @return Skill
     */
    public function setPriority(int $priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority.
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set status.
     *
     * @return Skill
     */
    public function setStatus(bool $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
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
