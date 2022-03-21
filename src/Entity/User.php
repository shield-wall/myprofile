<?php

namespace App\Entity;

use App\EventListener\UpdateCurriculumListener;
use App\Repository\UserRepository;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Stringable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('slug')]
#[UniqueEntity('email')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'fos_user')]
#[ORM\EntityListeners([UpdateCurriculumListener::class])]
class User implements UserInterface, Stringable
{
    /**
     * @var int
     */
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected ?int $id = null;
    /**
     * @var string
     */
    #[Assert\Length(max: 200)]
    #[Assert\Email]
    #[ORM\Column(type: Types::STRING, length: 200, unique: true)]
    protected ?string $email = null;
    #[Assert\NotBlank(groups: ['registration'])]
    #[Assert\Length(max: 50)]
    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    protected ?string $firstName = null;
    #[Assert\NotBlank(groups: ['registration'])]
    #[Assert\Length(max: 50)]
    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    protected ?string $lastName = null;
    /**
     * @Gedmo\Slug(fields={"firstName", "lastName", "id"}, updatable=false, unique=false)
     */
    #[Assert\Length(max: 50)]
    #[ORM\Column(type: Types::STRING, length: 50, unique: true)]
    private ?string $slug = null;
    #[Assert\Length(max: 250)]
    #[ORM\Column(type: Types::TEXT, length: 250, nullable: true)]
    protected ?string $headline = null;
    /**
     * This field is used in user`s profile.
     */
    #[Assert\Length(max: 100)]
    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    protected ?string $role = null;
    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    protected ?string $phone = null;
    #[Assert\Length(max: 20)]
    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    protected ?string $cell = null;
    #[ORM\Column(type: Types::TEXT, length: 350, nullable: true)]
    protected ?string $summary = null;
    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    protected ?string $country = null;
    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    protected ?string $state = null;
    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    protected ?string $city = null;
    #[Assert\Choice(['male', 'female'])]
    #[ORM\Column(type: Types::STRING, length: 6, nullable: true)]
    protected ?string $gender = null;
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    protected ?\DateTimeInterface $birthday = null;
    /**
     * @var Collection<UserSocialNetworking>
     */
    #[ORM\OneToMany(targetEntity: 'UserSocialNetworking', mappedBy: 'user')]
    protected Collection $userSocialNetworks;
    /**
     * @var Collection<Education>
     */
    #[ORM\OneToMany(targetEntity: 'Education', mappedBy: 'user')]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $educations;
    /**
     * @var Collection<Experience>
     */
    #[ORM\OneToMany(targetEntity: 'Experience', mappedBy: 'user')]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $experiences;
    /**
     * @var Collection<Skill>
     */
    #[ORM\OneToMany(targetEntity: 'Skill', mappedBy: 'user')]
    #[ORM\OrderBy(['priority' => 'ASC'])]
    protected Collection $skills;
    /**
     * @var Collection<Certification>
     */
    #[ORM\OneToMany(targetEntity: 'Certification', mappedBy: 'user')]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $certifications;
    #[ORM\Column(type: Types::STRING, length: 200, nullable: true)]
    protected ?string $keyWords = null;
    /**
     * @var Collection<UserLanguage>
     */
    #[ORM\OneToMany(targetEntity: 'UserLanguage', mappedBy: 'user')]
    private Collection $userLanguages;
    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];
    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $password;
    #[Assert\NotBlank(groups: ['registration', 'resetPassword'])]
    #[Assert\Length(min: 6)]
    private ?string $plainPassword = null;
    /**
     * @var string|null
     */
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $salt = null;
    /**
     * @Gedmo\Timestampable(on="create")
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;
    /**
     * @Gedmo\Timestampable(on="update")
     */
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;
    #[ORM\Column(type: Types::BOOLEAN)]
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

    public function setEmail(string $email): self
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getSalt(): ?string
    {
        return $this->salt;
    }

    public function setSalt(?string $salt): self
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
