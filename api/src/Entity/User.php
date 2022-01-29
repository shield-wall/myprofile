<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use DateTimeInterface;
use Stringable;

#[ApiResource(
    collectionOperations: [
        'get',
        'post' => ['validation_groups' => ['Default', 'postValidation']],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['anonymous', 'anonymous:item', 'anonymous:item:read']],
        ],
        'put',
        'delete',
        'patch',
    ],
    denormalizationContext: ['groups' => ['anonymous', 'anonymous:item']],
    normalizationContext: ['groups' => ['anonymous']],
)]

#[ORM\Entity]
#[ORM\Table(name: 'fos_user')]
#[UniqueEntity("slug")]
#[UniqueEntity("email")]
class User implements UserInterface, PasswordAuthenticatedUserInterface, Stringable
{
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue]
    #[Groups(['anonymous', 'user:read', 'admin:read'])]
    protected int $id;

    #[ORM\Column(type: Types::STRING, length: 200, unique: true)]
    #[Assert\Length(max:200)]
    #[Assert\Email]
    #[Assert\NotBlank]
    #[Groups(['anonymous:item', 'user', 'admin'])]
    protected string $email;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    #[Assert\Length(max:50)]
    #[Assert\NotBlank]
    #[Groups(['anonymous', 'user', 'admin'])]
    protected string | null $firstName;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    #[Assert\Length(max:50)]
    #[Assert\NotBlank]
    #[Groups(['anonymous', 'user', 'admin'])]
    protected string | null $lastName;

    /**
     * @Gedmo\Slug(fields={"firstName", "lastName", "id"}, updatable=false, unique=false)
     */
    #[ORM\Column(type: Types::STRING, length: 50, unique: true)]
    #[Assert\Length(max:50)]
    #[Groups(['anonymous', 'user', 'admin'])]
    protected string $slug;

    #[ORM\Column(type: Types::TEXT, length: 250, nullable: true)]
    #[Assert\Length(max:250)]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $headline;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    #[Assert\Length(max:100)]
    #[Groups(['anonymous', 'user', 'admin'])]
    protected string | null $role;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $phone;

    #[ORM\Column(type: Types::STRING, length: 20, nullable: true)]
    #[Assert\Length(max:20)]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $cell;

    #[ORM\Column(type: Types::TEXT, length: 350, nullable: true)]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $summary;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $country;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $state;

    #[ORM\Column(type: Types::STRING, length: 50, nullable: true)]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $city;

    #[ORM\Column(type: Types::STRING, length: 6, nullable: true)]
    #[Assert\Choice(['male', 'female'])]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $gender;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['user:item', 'admin:item'])]
    protected DateTimeInterface | null $birthday;

    /**
     * @var UserSocialNetworking[]|Collection<int, UserSocialNetworking>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'UserSocialNetworking')]
    protected Collection $userSocialNetworks;

    /**
     * @var Education[]|Collection<int, Education>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'Education')]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $educations;

    /**
     * @var Experience[]|Collection<int, Experience>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'Experience')]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $experiences;

    /**
     * @var Skill[]|Collection<int, Skill>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'Skill')]
    #[ORM\OrderBy(['priority' => 'ASC'])]
    protected Collection $skills;

    /**
     * @var Certification[]|Collection<int, Certification>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'Certification')]
    #[ORM\OrderBy(['periodStart' => 'DESC'])]
    protected Collection $certifications;

    /**
     * @var UserLanguage[]|Collection<int, UserLanguage>
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: 'UserLanguage')]
    protected Collection $userLanguages;

    #[ORM\Column(type: Types::STRING, length: 200, nullable: true)]
    #[Groups(['anonymous:item:read', 'user:item', 'admin:item'])]
    protected string | null $keyWords;

    #[ORM\Column(type: Types::JSON)]
    protected array | null $roles = [];

    #[ORM\Column(type: Types::STRING, length: 255)]
    protected string $password;

    #[Assert\NotBlank(groups: ['postValidation'])]
    #[Assert\Length(min:6)]
    #[SerializedName('password')]
    #[Groups(['anonymous:item', 'user', 'admin'])]
    protected string | null $plainPassword;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected string | null $salt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    #[Groups(['anonymous:item:read'])]
    protected DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Gedmo\Timestampable(on: 'update')]
    #[Groups(['anonymous:item:read'])]
    protected DateTimeInterface | null $updatedAt;

    #[ORM\Column(type: Types::BOOLEAN)]
    #[Groups(['read', 'user:item', 'admin:item'])]
    protected bool $isVerified = false;

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

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): User
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

    public function setGender(string | null $gender): User
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

    #[Groups(['anonymous', 'user:read', 'admin:read'])]
    public function getProfileImage(): string
    {
        return sprintf('/users/%s/profile.webp', md5($this->getEmail()));
    }

    #[Groups(['anonymous', 'user:read', 'admin:read'])]
    public function getBackgroundImage(): string
    {
        return sprintf('/users/%s/background.webp', md5($this->getEmail()));
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

    /**
     * @param array<string> $roles
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return array<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
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

        return $this->plainPassword;
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

    public function getUserIdentifier(): string
    {
        return $this->getUsername();
    }

    /**
     * @internal this method was created to use with fixtures
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @internal this method was created to use with fixtures
     */
    public function setCreatedAt(DateTimeInterface $dateTime): self
    {
        $this->createdAt = $dateTime;

        return $this;
    }

    /**
     * @internal this method was created to use with fixtures
     */
    public function setUpdatedAt(DateTimeInterface $dateTime): self
    {
        $this->updatedAt = $dateTime;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getUsername();
    }
}
