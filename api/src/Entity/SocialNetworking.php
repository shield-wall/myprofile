<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="social_networking")
 * @ORM\Entity(repositoryClass="App\Repository\SocialNetworkingRepository")
 */
class SocialNetworking
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected int $id;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50)
     */
    protected string $name;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50)
     */
    protected string $icon;

    /**
     * @ORM\OneToMany(targetEntity="UserSocialNetworking", mappedBy="socialNetworking")
     */
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
