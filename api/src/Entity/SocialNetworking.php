<?php

declare(strict_types=1);

namespace App\Entity;

use Stringable;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    attributes: ["security" => "is_granted('ROLE_ADMIN')"],
)]
#[ORM\Table(name: 'social_networking')]
#[ORM\Entity]
class SocialNetworking implements Stringable
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\Length(max: 50)]
    protected string $name;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Assert\Length(max: 50)]
    protected string $icon;

    /**
     * @var array<UserSocialNetworking>|Collection<int, UserSocialNetworking>
     */
    #[ORM\OneToMany(mappedBy: 'socialNetworking', targetEntity: UserSocialNetworking::class)]
    protected Collection $userSocialNetworks;

    public function __construct()
    {
        $this->userSocialNetworks = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     */
    public function setName(string $name): SocialNetworking
    {
        $this->name = $name;
        return $this;
    }

    /**
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     */
    public function setIcon(string $icon): SocialNetworking
    {
        $this->icon = $icon;
        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
