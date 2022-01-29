<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

#[ORM\Table(name: 'experience')]
#[ORM\Entity]
class Experience
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'experiences')]
    #[ORM\JoinColumn(name: 'user_id')]
    protected User $user;

    /**
     * @Assert\Length(max="150")
     * @Assert\NotBlank()
     *
     */
    #[ORM\Column(type: Types::STRING, length: 150)]
    protected string $title;

    /**
     * @Assert\Length(max="50")
     * @Assert\NotBlank()
     *
     */
    #[ORM\Column(type: Types::STRING, length: 50)]
    protected string $company;

    /**
     * @Assert\NotBlank()
     *
     * @var $description
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
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     */
    public function setUser(User $user): Experience
    {
        $this->user = $user;
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
    public function setTitle(string $title): Experience
    {
        $this->title = $title;
        return $this;
    }

    /**
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     */
    public function setCompany(string $company): Experience
    {
        $this->company = $company;
        return $this;
    }

    /**
     */
    public function getDescription(): mixed
    {
        return $this->description;
    }

    /**
     */
    public function setDescription(mixed $description): Experience
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
    public function setPeriodStart(DateTimeInterface $periodStart): Experience
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
    public function setPeriodEnd(?DateTimeInterface $periodEnd): Experience
    {
        $this->periodEnd = $periodEnd;
        return $this;
    }
}
