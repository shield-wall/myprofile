<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\SkillRepository;
use App\ThirdCode\Contracts\SkillInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'skill')]
#[ORM\Entity(repositoryClass: SkillRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class Skill implements SkillInterface
{
    #[ORM\Column(name: 'id', type: Types::INTEGER)]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'skills')]
    #[ORM\JoinColumn(name: 'user_id')]
    protected ?UserInterface $user = null;

    #[Assert\Length(max: 50)]
    #[ORM\Column(name: 'name', type: Types::STRING, length: 50)]
    private ?string $name = null;

    #[Assert\Range(min: 0, max: 100)]
    #[ORM\Column(name: 'level_experience', type: Types::SMALLINT)]
    private int $levelExperience;

    #[ORM\Column(name: 'priority', type: Types::SMALLINT, nullable: true)]
    private ?int $priority = null;

    #[ORM\Column(name: 'status', type: Types::BOOLEAN)]
    private bool $status = true;

    public function getId(): int
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

    public function getName(): ?string
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

    public function setUser(UserInterface $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function getTitle(): string
    {
        //@TODO make name required.

        return $this->getName() ?? '';
    }
}
