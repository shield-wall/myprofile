<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="social_networking")
 * @ORM\Entity(repositoryClass="App\Repository\SocialNetworkingRepository")
 * @ORM\EntityListeners({"App\EventListener\UpdateCurriculumListener"})
 */
class SocialNetworking
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50)
     */
    protected $icon;

    /**
     * @ORM\OneToMany(targetEntity="UserSocialNetworking", mappedBy="socialNetworking")
     */
    protected $userSocialNetworks;

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
     * @return SocialNetworking
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
