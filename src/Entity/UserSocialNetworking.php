<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(
 *     name="user_social_networking",
 *     uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="relations_idx",
 *              columns={"user_id", "social_networking_id"})
 *      }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\UserSocialNetworkingRepository")
 * @ORM\EntityListeners({"App\EventListener\UpdateCurriculumListener"})
 */
#[UniqueEntity(fields: ['user', 'socialNetworking'], errorPath: 'socialNetworking')]
class UserSocialNetworking
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var int
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userSocialNetworks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var User
     */
    protected $user;
    /**
     * @ORM\ManyToOne(targetEntity="SocialNetworking", inversedBy="userSocialNetworks", fetch="EAGER")
     * @ORM\JoinColumn(name="social_networking_id", referencedColumnName="id", nullable=false)
     *
     * @var SocialNetworking|null
     */
    protected $socialNetworking;
    /**
     * @ORM\Column(type="string", length=200)
     * @var string
     */
    #[Assert\Length(max: 200)]
    protected $link;
    public function getId(): int
    {
        return $this->id;
    }
    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): UserSocialNetworking
    {
        $this->user = $user;
        return $this;
    }
    public function getSocialNetworking(): ?SocialNetworking
    {
        return $this->socialNetworking;
    }
    public function setSocialNetworking(?SocialNetworking $socialNetworking): UserSocialNetworking
    {
        $this->socialNetworking = $socialNetworking;
        return $this;
    }
    public function getLink(): string
    {
        return $this->link;
    }
    public function setLink(string $link): UserSocialNetworking
    {
        $this->link = $link;
        return $this;
    }
}
