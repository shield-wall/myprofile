<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;

#[ApiResource(
    normalizationContext: ['groups' => ['anonymous']],
    denormalizationContext: ['groups' => ['anonymous']],
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['anonymous', 'anonymous:item:read']],
        ],
        'put',
        'delete',
        'patch'
    ],
)]
/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 * @ORM\EntityListeners({"App\EventListener\UpdateCurriculumListener"})
 * @UniqueEntity("slug")
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"anonymous", "user:read", "admin:read"})
     */
    protected int $id;


    /**
     * @Assert\Length(max="200")
     * @Assert\Email
     * @ORM\Column(type="string", length=200, unique=true)
     *
     * @Groups({"anonymous", "user", "admin"})
     */
    protected string $email;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Groups({"anonymous", "user", "admin"})
     */
    protected string | null $firstName;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Length(max="50")
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Groups({"anonymous", "write", "user", "admin"})
     */
    protected string | null $lastName;

    /**
     * @Assert\Length(max="50")
     * @Gedmo\Slug(fields={"firstName", "lastName", "id"}, updatable=false, unique=false)
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @Groups({"anonymous", "user", "admin"})
     */
    private string $slug;

    /**
     * @Assert\Length(max="250")
     * @ORM\Column(type="text", length=250, nullable=true)
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $headline;

    /**
     * This field is used in user`s profile
     *
     * @Assert\Length(max="100")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected string | null $role;

    /**
     * @ORM\Column(type="string",length=20, nullable=true)
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $phone;

    /**
     * @Assert\Length(max="20")
     * @ORM\Column(type="string",length=20, nullable=true)
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $cell;

    /**
     * @ORM\Column(type="text", length=350, nullable=true)
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $summary;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $country;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $state;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $city;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Assert\Choice({"male", "female"})
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $gender;

    /**
     * @ORM\Column(type="date", nullable=true)
     *
     * @Groups({"user:item", "admin:item"})
     */
    protected DateTimeInterface | null $birthday;

    /**
     * @ORM\OneToMany(targetEntity="UserSocialNetworking", mappedBy="user")
     */
    protected Collection $userSocialNetworks;

    /**
     * @ORM\OneToMany(targetEntity="Education", mappedBy="user")
     * @ORM\OrderBy({"periodStart" = "DESC"})
     */
    protected Collection $educations;

    /**
     * @ORM\OneToMany(targetEntity="Experience", mappedBy="user")
     * @ORM\OrderBy({"periodStart" = "DESC"})
     */
    protected Collection $experiences;

    /**
     * @ORM\OneToMany(targetEntity="Skill", mappedBy="user")
     * @ORM\OrderBy({"priority" = "ASC"})
     */
    protected Collection $skills;

    /**
     * @ORM\OneToMany(targetEntity="Certification", mappedBy="user")
     * @ORM\OrderBy({"periodStart" = "DESC"})
     */
    protected Collection $certifications;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     *
     * @Groups({"anonymous:item:read", "user:item", "admin:item"})
     */
    protected string | null $keyWords;

    /**
     * @ORM\OneToMany(targetEntity="UserLanguage", mappedBy="user")
     */
    private Collection $userLanguages;

    /**
     * @ORM\Column(type="json")
     */
    private array | null $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $password;

    /**
     * @Assert\NotBlank(groups={"registration", "resetPassword"})
     * @Assert\Length(min=6)
     */
    private string | null $plainPassword;


    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected string | null $salt;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     *
     * @Groups("anonymous:item:read")
     */
    private DateTimeInterface $createdAt;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @Groups("anonymous:item:read")
     */
    private DateTimeInterface | null $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Groups("read")
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug($slug): User
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUserSocialNetworks(): Collection
    {
        return $this->userSocialNetworks;
    }

    public function setUserSocialNetworks(UserSocialNetworking $socialNetworking): User
    {
        $socialNetworking->setUser($this);
        $this->getUserSocialNetworks()->add($socialNetworking);

        return $this;
    }

    public function removeUserSocialNetworks(UserSocialNetworking $socialNetworking): User
    {
        $this->getUserSocialNetworks()->removeElement($socialNetworking);

        return $this;
    }

    public function getEducations(): Collection
    {
        return $this->educations;
    }

    /**
     * @param Education $education
     * @return User
     */
    public function addEducations(Education $education): User
    {
        if (!$this->educations->contains($education)) {
            $this->educations->add($education);
        }

        return $this;
    }

    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    /**
     * @param Experience $experience
     * @return User
     */
    public function addExperiences(Experience $experience): User
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences->add($experience);
        }

        return $this;
    }

    public function getSkills(): Collection
    {
        return $this->skills;
    }

    /**
     * @param Skill $skill
     * @return User
     */
    public function addSkills(Skill $skill): User
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }

        return $this;
    }

    public function getCertifications(): Collection
    {
        return $this->certifications;
    }

    /**
     * @param Certification $certification
     * @return User
     */
    public function addCertifications(Certification $certification): User
    {
        if (!$this->certifications->contains($certification)) {
            $this->certifications->add($certification);
        }

        return $this;
    }

    public function getCountry(): string | null
    {
        return $this->country;
    }

    public function setCountry(null | string $country): User
    {
        $this->country = $country;
        return $this;
    }


    public function getCity(): string | null
    {
        return $this->city;
    }

    public function setCity(string | null $city): User
    {
        $this->city = $city;

        return $this;
    }

    public function getBirthday(): DateTimeInterface | null
    {
        return $this->birthday;
    }

    public function setBirthday(DateTimeInterface | null $birthday): User
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getFirstName(): string | null
    {
        return $this->firstName;
    }

    public function setFirstName(string | null $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string | null
    {
        return $this->lastName;
    }

    public function setLastName(string | null $lastName): User
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getHeadline(): string | null
    {
        return $this->headline;
    }

    public function setHeadline(string | null $headline): User
    {
        $this->headline = $headline;
        return $this;
    }

    public function getRole(): string | null
    {
        return $this->role;
    }

    public function setRole(string | null $role): User
    {
        $this->role = $role;
        return $this;
    }

    public function getCell(): string | null
    {
        return $this->cell;
    }

    public function setCell(string | null $cell): User
    {
        $this->cell = $cell;
        return $this;
    }

    public function getPhone(): string | null
    {
        return $this->phone;
    }

    public function setPhone(string | null $phone): User
    {
        $this->phone = $phone;
        return $this;
    }

    public function getGender(): string | null
    {
        return $this->gender;
    }

    public function setGender(string | null $gender)
    {
        $this->gender = $gender;
        return $this;
    }

    public function getSummary(): string | null
    {
        return $this->summary;
    }

    public function setSummary(string | null $summary): User
    {
        $this->summary = $summary;

        return $this;
    }

    public function getState(): string | null
    {
        return $this->state;
    }

    public function setState(string | null $state): User
    {
        $this->state = $state;
        return $this;
    }

    public function getKeyWords(): string | null
    {
        return $this->keyWords;
    }

    public function setKeyWords(string | null $keyWords): User
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

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }

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

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getPlainPassword(): string | null
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string | null $plainPassword): User
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getSalt(): string | null
    {
        return $this->salt;
    }

    public function setSalt(string | null $salt): User
    {
        $this->salt = $salt;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->getEmail();
    }

    public function eraseCredentials(): string | null
    {
        $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): User
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getUsername();
    }
}
