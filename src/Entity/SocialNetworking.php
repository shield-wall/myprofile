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
     * @var Collection<UserSocialNetworking>
     */
    #[ORM\OneToMany(mappedBy: 'socialNetworking', targetEntity: UserSocialNetworking::class)]
    protected Collection $userSocialNetworks;

    public function __construct()
    {
        $this->userSocialNetworks = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return SocialNetworking
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     *
     * @return SocialNetworking
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getName();
    }
}
