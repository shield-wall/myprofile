<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'user_social_networking')]
#[ORM\UniqueConstraint(name: "relations_idx", columns: ['user_id', 'social_networking_id'])]
#[ORM\Entity]
#[UniqueEntity(fields: ['user', 'socialNetwork'], errorPath: 'socialNetworking')]
class UserSocialNetworking
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\ManyToOne(targetEntity: 'User', inversedBy: 'userSocialNetworks')]
    #[ORM\JoinColumn(name: 'user_id')]
    protected User $user;

    #[ORM\ManyToOne(targetEntity: SocialNetworking::class, fetch: 'EAGER', inversedBy: 'userSocialNetworks')]
    #[ORM\JoinColumn(name: 'social_networking_id', nullable: false)]
    protected ?SocialNetworking $socialNetworking = null;

    #[ORM\Column(type: Types::STRING, length: 200)]
    #[Assert\Length(max: 200)]
    protected string $link;

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
    public function setUser(User $user): UserSocialNetworking
    {
        $this->user = $user;
        return $this;
    }

    /**
     */
    public function getSocialNetworking(): ?SocialNetworking
    {
        return $this->socialNetworking;
    }

    /**
     */
    public function setSocialNetworking(?SocialNetworking $socialNetworking): UserSocialNetworking
    {
        $this->socialNetworking = $socialNetworking;
        return $this;
    }

    /**
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     */
    public function setLink(string $link): UserSocialNetworking
    {
        $this->link = $link;
        return $this;
    }
}
