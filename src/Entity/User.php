<?php

namespace App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Stringable;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @ORM\EntityListeners({"App\EventListener\UpdateCurriculumListener"})
 */
#[UniqueEntity('slug')]
#[UniqueEntity('email')]
class User implements UserInterface, Stringable
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
     * @ORM\Column(type="string", length=200, unique=true)
     *
     * @var string
     */
    #[Assert\Length(max: 200)]
    #[Assert\Email]
    protected $email;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    #[Assert\NotBlank(groups: ['registration'])]
    #[Assert\Length(max: 50)]
    protected $firstName;
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    #[Assert\NotBlank(groups: ['registration'])]
    #[Assert\Length(max: 50)]
    protected $lastName;
    /**
     * @Gedmo\Slug(fields={"firstName", "lastName", "id"}, updatable=false, unique=false)
     * @ORM\Column(type="string", length=50, unique=true)
     */
    #[Assert\Length(max: 50)]
    private $slug;
    /**
     * @ORM\Column(type="text", length=250, nullable=true)
     */
    #[Assert\Length(max: 250)]
    protected $headline;
    /**
     * This field is used in user`s profile
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    #[Assert\Length(max: 100)]
    protected $role;
    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     */
    protected $phone;
    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     */
    #[Assert\Length(max: 20)]
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
     */
    #[Assert\Choice(['male', 'female'])]
    protected $gender;
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;
    /**
     * @ORM\OneToMany(targetEntity="UserSocialNetworking", mappedBy="user")
     */
    protected $userSocialNetworks;
    /**
     * @ORM\OneToMany(targetEntity="Education", mappedBy="user")
     * @ORM\OrderBy({"periodStart" = "DESC"})
     */
    protected $educations;
    /**
     * @ORM\OneToMany(targetEntity="Experience", mappedBy="user")
     * @ORM\OrderBy({"periodStart" = "DESC"})
     */
    protected $experiences;
    /**
     * @ORM\OneToMany(targetEntity="Skill", mappedBy="user")
     * @ORM\OrderBy({"priority" = "ASC"})
     */
    protected $skills;
    /**
     * @ORM\OneToMany(targetEntity="Certification", mappedBy="user")
     * @ORM\OrderBy({"periodStart" = "DESC"})
     */
    protected $certifications;
    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $keyWords;
    /**
     * @ORM\OneToMany(targetEntity="UserLanguage", mappedBy="user")
     */
    private $userLanguages;
    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];
    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $password;
    #[Assert\NotBlank(groups: ['registration', 'resetPassword'])]
    #[Assert\Length(min: 6)]
    private ?string $plainPassword = null;
    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    protected $salt;
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
    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isVerified = false;
    public function __construct()
    {
        $this->userSocialNetworks = new ArrayCollection();
        $this->educations = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->certifications = new ArrayCollection();
        $this->userLanguages = new ArrayCollection();
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
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
        return $this->userSocialNetworks;
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
     * @return User
     */
    public function addEducations(Education $education)
    {
        if (!$this->educations->contains($education)) {
            $this->educations->add($education);
        }

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
     * @return User
     */
    public function addExperiences(Experience $experience)
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences->add($experience);
        }

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
     * @return User
     */
    public function addSkills(Skill $skill)
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }

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
     * @return User
     */
    public function addCertifications(Certification $certification)
    {
        if (!$this->certifications->contains($certification)) {
            $this->certifications->add($certification);
        }

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
        return $this->firstName;
    }
    /**
     * @param mixed $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    /**
     * @param mixed $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
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
            $userLanguage->setUser($this);
        }

        return $this;
    }
    public function removeUserLanguage(UserLanguage $userLanguage): self
    {
        if ($this->userLanguages->contains($userLanguage)) {
            $this->userLanguages->removeElement($userLanguage);
            // set the owning side to null (unless already changed)
            if ($userLanguage->getUser() === $this) {
                $userLanguage->setUser(null);
            }
        }

        return $this;
    }
    /**
     * @return DateTime|DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
    /**
     * @return DateTime|DateTimeImmutable
     */
    public function getUpdatedAt(): DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    public function setPlainPassword(?string $plainPassword): User
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }
    public function getSalt(): ?string
    {
        return $this->salt;
    }
    public function setSalt(?string $salt): User
    {
        $this->salt = $salt;
        return $this;
    }
    public function getUsername()
    {
        return $this->getEmail();
    }
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
    public function isVerified(): bool
    {
        return $this->isVerified;
    }
    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
    public function __toString(): string
    {
        return $this->getUsername();
    }
}
