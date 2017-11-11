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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user_social_networks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $social_networking_id;

    /**
     * @ORM\ManyToOne(targetEntity="SocialNetworking", inversedBy="user_social_networks", fetch="EAGER")
     * @ORM\JoinColumn(name="social_networking_id", referencedColumnName="id")
     */
    protected $social_networking;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $link;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserSocialNetworking
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set socialNetworkingId
     *
     * @param integer $socialNetworkingId
     *
     * @return UserSocialNetworking
     */
    public function setSocialNetworkingId($socialNetworkingId)
    {
        $this->social_networking_id = $socialNetworkingId;

        return $this;
    }

    /**
     * Get socialNetworkingId
     *
     * @return integer
     */
    public function getSocialNetworkingId()
    {
        return $this->social_networking_id;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return UserSocialNetworking
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set socialNetworking
     *
     * @param \AppBundle\Entity\SocialNetworking $socialNetworking
     *
     * @return UserSocialNetworking
     */
    public function setSocialNetworking(\AppBundle\Entity\SocialNetworking $socialNetworking = null)
    {
        $this->social_networking = $socialNetworking;

        return $this;
    }

    /**
     * Get socialNetworking
     *
     * @return \AppBundle\Entity\SocialNetworking
     */
    public function getSocialNetworking()
    {
        return $this->social_networking;
    }

    /**
     * Get socialNetworking
     *
     * @return \AppBundle\Entity\SocialNetworking
     */
    public function getSocial_networking()
    {
        return $this->social_networking;
    }
}
