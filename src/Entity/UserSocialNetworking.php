<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\UserSocialNetworkingRepository;
use App\ThirdCode\Contracts\UserSocialNetworkInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity(fields: ['user', 'socialNetworking'], errorPath: 'socialNetworking')]
#[ORM\Table(name: 'user_social_networking')]
#[ORM\UniqueConstraint(name: 'relations_idx', columns: ['user_id', 'social_networking_id'])]
#[ORM\Entity(repositoryClass: UserSocialNetworkingRepository::class)]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class UserSocialNetworking implements UserSocialNetworkInterface, EntityInterface, HasUserInterface
{
    use HasUserTrait;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'userSocialNetworks')]
    #[ORM\JoinColumn(name: 'user_id', nullable: false)]
    protected UserInterface $user;

    #[ORM\ManyToOne(targetEntity: SocialNetworking::class, fetch: 'EAGER', inversedBy: 'userSocialNetworks')]
    #[ORM\JoinColumn(name: 'social_networking_id', nullable: false)]
    protected SocialNetworking $socialNetworking;

    #[Assert\Length(max: 200)]
    #[ORM\Column(type: Types::STRING, length: 200)]
    protected string $link;

    public function getId(): int
    {
        return $this->id;
    }

    public function getSocialNetworking(): SocialNetworking
    {
        return $this->socialNetworking;
    }

    public function setSocialNetworking(SocialNetworking $socialNetworking): self
    {
        $this->socialNetworking = $socialNetworking;

        return $this;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getIconClass(): string
    {
        return $this->socialNetworking->getIcon();
    }
}
