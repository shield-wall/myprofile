<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_social_networking",uniqueConstraints={@ORM\UniqueConstraint(name="relations_idx", columns={"user_id", "social_networking_id"})})
 */
class UserSocialNetworking
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $social_networking_id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user_social_networks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="SocialNetworking", inversedBy="user_social_networks", fetch="EAGER")
     * @ORM\JoinColumn(name="social_networking_id", referencedColumnName="id")
     */
    protected $social_networking;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $link;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getSocialNetworking()
    {
        return $this->social_networking;
    }

    public function getSocial_networking()
    {
        return $this->social_networking;
    }

    /**
     * @param mixed $social_networking
     */
    public function setSocialNetworking($social_networking)
    {
        $this->social_networking = $social_networking;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     * @return UserSocialNetworking
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    public function __toString()
    {
        return $this->getLink();
    }
}