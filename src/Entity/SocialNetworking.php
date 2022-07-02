<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\SocialNetworkingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Stringable;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'social_networking')]
#[ORM\Entity(repositoryClass: SocialNetworkingRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class SocialNetworking implements Stringable
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected ?int $id = null;

    #[Assert\Length(max: 50)]
    #[ORM\Column(type: Types::STRING, length: 50)]
    protected ?string $name = null;

    #[Assert\Length(max: 50)]
    #[ORM\Column(type: Types::STRING, length: 50)]
    protected ?string $icon = null;

    /**
     * @var Collection<UserUserSocialNetworking>
     */
    #[ORM\OneToMany(mappedBy: 'socialNetworking', targetEntity: UserUserSocialNetworking::class)]
    protected Collection $userSocialNetworks;

    public function __construct()
    {
        $this->userSocialNetworks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }
}
