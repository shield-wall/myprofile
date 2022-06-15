<?php

namespace App\Entity;

use App\Entity\Contract\ImageEntityInterface;
use App\Entity\Traits\HasImageEntity;
use App\EventListener\SetWebSiteInUserListener;
use App\EventListener\UpdateCurriculumListener;
use App\Repository\UserRepository;
use App\ThirdCode\Contracts\UserInfoInterface;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Stringable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[UniqueEntity('slug')]
#[UniqueEntity('email')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'fos_user')]
#[ORM\EntityListeners([UpdateCurriculumListener::class, SetWebSiteInUserListener::class])]
class User implements UserInterface, PasswordAuthenticatedUserInterface, Stringable, UserInfoInterface, ImageEntityInterface
{
    use HasImageEntity;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected ?int $id = null;

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
     * @var Collection<UserUserSocialNetworking>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserUserSocialNetworking::class)]
    protected Collection $userSocialNetworks;

    /**
     * @var Collection<Education>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Education::class)]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $educations;

    /**
     * @var Collection<Experience>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Experience::class)]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $experiences;

    /**
     * @var Collection<Skill>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Skill::class)]
    #[ORM\OrderBy(['priority' => 'ASC'])]
    protected Collection $skills;

    /**
     * @var Collection<Certification>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Certification::class)]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $certifications;

    #[ORM\Column(type: Types::STRING, length: 200, nullable: true)]
    protected ?string $keyWords = null;

    /**
     * @var Collection<UserLanguage>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserLanguage::class)]
    private Collection $userLanguages;

    #[ORM\Column(type: Types::JSON)]
    private array $roles = [];

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $password;

    #[Assert\NotBlank(groups: ['registration', 'resetPassword'])]
    #[Assert\Length(min: 6)]
    private ?string $plainPassword = null;

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

    private string $backgroundImage;

    private string $website;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug($slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getUserSocialNetworks(): Collection
    {
        return $this->userSocialNetworks;
    }

    public function setUserSocialNetworks(UserUserSocialNetworking $socialNetworking)
    {
        $socialNetworking->setUser($this);
        $this->getUserSocialNetworks()->add($socialNetworking);
    }

    public function removeUserSocialNetworks(UserUserSocialNetworking $socialNetworking): static
    {
        $this->getUserSocialNetworks()->removeElement($socialNetworking);

        return $this;
    }

    public function getEducations(): Collection
    {
        return $this->educations;
    }

    public function addEducations(Education $education): static
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

    public function addExperiences(Experience $experience): static
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

    public function addSkills(Skill $skill): static
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

    public function addCertifications(Certification $certification): static
    {
        if (!$this->certifications->contains($certification)) {
            $this->certifications->add($certification);
        }

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry($country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity($city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getBirthday(): ?DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday($birthday): static
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getFirstName(): string
    {
        //@TODO make first name required

        return $this->firstName ?? '';
    }

    public function setFirstName($firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        // @TODO make lastname Required.
        return $this->lastName ?? '';
    }

    public function setLastName($lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getHeadline(): ?string
    {
        return $this->headline;
    }

    public function setHeadline($headline): static
    {
        $this->headline = $headline;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole($role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getCell(): ?string
    {
        return $this->cell;
    }

    public function setCell($cell): static
    {
        $this->cell = $cell;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone($phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender($gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary($summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState($state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getKeyWords(): ?string
    {
        return $this->keyWords;
    }

    public function setKeyWords(?string $keyWords): static
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
        return $this->getImage();
    }

    public function getBackgroundImage(): string
    {
        return $this->backgroundImage ?? sprintf('/users/%s/background.webp', md5($this->getEmail()));
    }

    public function setBackgroundImage(string $image): static
    {
        $this->backgroundImage = $image;

        return $this;
    }

    public function getImage(): string
    {
        return $this->image ?? sprintf('/users/%s/profile.webp', md5($this->getEmail()));
    }

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

    // @TODO remove this in symfony 6
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    public function getPositionTitle(): string
    {
        return $this->getRole() ?? '';
    }

    public function getWebSite(): ?string
    {
        return $this->website;
    }

    public function setWebSite(?string $website): static
    {
        $this->website = $website;

        return $this;
    }

    public function getPhone1(): ?string
    {
        return $this->getPhone();
    }

    public function getPhone2(): ?string
    {
        return $this->getCell();
    }

    public function getAbout(): ?string
    {
        return $this->getSummary();
    }
}
