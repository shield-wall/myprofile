<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="social_networking")
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
     * @ORM\Column(type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $icon;

    /**
     * @ORM\OneToMany(targetEntity="UserSocialNetworking", mappedBy="social_networking")
     */
    protected $user_social_networks;

    public function __construct()
    {
        $this->user_social_networks = new ArrayCollection();
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