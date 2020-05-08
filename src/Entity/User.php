<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @UniqueEntity("slug")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $first_name;

    /**
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $last_name;

    /**
     * @Assert\Length(max="50")
     * @Gedmo\Slug(fields={"first_name", "last_name", "id"}, updatable=false, unique=false)
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $slug;

    /**
     * @Assert\Length(max="250")
     * @ORM\Column(type="text", length=250, nullable=true)
     */
    protected $headline;

    /**
     * @Assert\Length(max="100")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $role;

    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     */
    protected $phone;

    /**
     * @Assert\Length(max="20")
     * @ORM\Column(type="string",length=20, nullable=true)
     */
    protected $cell;

    /**
     * @ORM\Column(type="text", length=350, nullable=true)
     */
    protected $summary;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Assert\Choice({"male", "female"})
     */
    protected $gender;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;

    /**
     * @ORM\OneToMany(targetEntity="UserSocialNetworking", mappedBy="user")
     */
    protected $user_social_networks;

    /**
     * @ORM\OneToMany(targetEntity="Education", mappedBy="user_id")
     * @ORM\OrderBy({"period_start" = "DESC"})
     */
    protected $educations;

    /**
     * @ORM\OneToMany(targetEntity="Experience", mappedBy="user_id")
     * @ORM\OrderBy({"period_start" = "DESC"})
     */
    protected $experiences;

    /**
     * @ORM\OneToMany(targetEntity="Skill", mappedBy="user_id")
     * @ORM\OrderBy({"priority" = "ASC"})
     */
    protected $skills;

    /**
     * @ORM\OneToMany(targetEntity="Certification", mappedBy="user_id")
     * @ORM\OrderBy({"periodStart" = "DESC"})
     */
    protected $certifications;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $keyWords;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserLanguage", mappedBy="user_id")
     */
    private $userLanguages;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        parent::__construct();

        $this->user_social_networks = new ArrayCollection();
        $this->educations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->certifications = new ArrayCollection();
        $this->userLanguages = new ArrayCollection();
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getUserSocialNetworks()
    {
        return $this->user_social_networks;
    }

    public function setUserSocialNetworks(UserSocialNetworking $socialNetworking)
    {
        $socialNetworking->setUser($this);
        $this->getUserSocialNetworks()->add($socialNetworking);
    }

    public function removeUserSocialNetworks(UserSocialNetworking $socialNetworking)
    {
        $this->getUserSocialNetworks()->removeElement($socialNetworking);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getEducations()
    {
        return $this->educations;
    }

    /**
     * @param Education $education
     * @return User
     */
    public function addEducations(Education $education)
    {
        if (!$this->educations->contains($education))
            $this->educations->add($education);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * @param Experience $experience
     * @return User
     */
    public function addExperiences(Experience $experience)
    {
        if (!$this->experiences->contains($experience))
            $this->experiences->add($experience);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param Skill $skill
     * @return User
     */
    public function addSkills(Skill $skill)
    {
        if (!$this->skills->contains($skill))
            $this->skills->add($skill);

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCertifications()
    {
        return $this->certifications;
    }

    /**
     * @param Certification $certification
     * @return User
     */
    public function addCertifications(Certification $certification)
    {
        if (!$this->certifications->contains($certification))
            $this->certifications->add($certification);

        return $this;
    }


    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return User
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     * @return User
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     * @return User
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @param mixed $headline
     * @return User
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCell()
    {
        return $this->cell;
    }

    /**
     * @param mixed $cell
     * @return User
     */
    public function setCell($cell)
    {
        $this->cell = $cell;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     * @return User
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     * @return User
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeyWords(): ?string
    {
        return $this->keyWords;
    }

    /**
     * @param string $keyWords
     * @return User
     */
    public function setKeyWords(?string $keyWords)
    {
        $this->keyWords = $keyWords;
        return $this;
    }

    public function getCurriculumPath(): string
    {
        return sprintf('users/%s/curriculum/', md5($this->getEmail()));
    }

    public function getProfileImage(): string
    {
        return sprintf('users/%s/profile.webp', md5($this->getEmail()));
    }

    public function getBackgroundImage(): string
    {
        return sprintf('users/%s/background.webp', md5($this->getEmail()));
    }

    /**
     * @return Collection|UserLanguage[]
     */
    public function getUserLanguages(): Collection
    {
        return $this->userLanguages;
    }

    public function addUserLanguage(UserLanguage $userLanguage): self
    {
        if (!$this->userLanguages->contains($userLanguage)) {
            $this->userLanguages[] = $userLanguage;
            $userLanguage->setUserId($this);
        }

        return $this;
    }

    public function removeUserLanguage(UserLanguage $userLanguage): self
    {
        if ($this->userLanguages->contains($userLanguage)) {
            $this->userLanguages->removeElement($userLanguage);
            // set the owning side to null (unless already changed)
            if ($userLanguage->getUserId() === $this) {
                $userLanguage->setUserId(null);
            }
        }

        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
}
