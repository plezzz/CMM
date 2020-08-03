<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $editedOn;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $editedBy;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cmAppToken;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cmAppSecret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cmAccessToken;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cmAccessSecret;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTimeInterface $createdOn): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getEditedOn(): ?\DateTimeInterface
    {
        return $this->editedOn;
    }

    public function setEditedOn(?\DateTimeInterface $editedOn): self
    {
        $this->editedOn = $editedOn;

        return $this;
    }

    public function getEditedBy(): ?self
    {
        return $this->editedBy;
    }

    public function setEditedBy(?self $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCmAppToken(): ?string
    {
        return $this->cmAppToken;
    }

    public function setCmAppToken(?string $cmAppToken): self
    {
        $this->cmAppToken = $cmAppToken;

        return $this;
    }

    public function getCmAppSecret(): ?string
    {
        return $this->cmAppSecret;
    }

    public function setCmAppSecret(?string $cmAppSecret): self
    {
        $this->cmAppSecret = $cmAppSecret;

        return $this;
    }

    public function getCmAccessToken(): ?string
    {
        return $this->cmAccessToken;
    }

    public function setCmAccessToken(?string $cmAccessToken): self
    {
        $this->cmAccessToken = $cmAccessToken;

        return $this;
    }

    public function getCmAccessSecret(): ?string
    {
        return $this->cmAccessSecret;
    }

    public function setCmAccessSecret(?string $cmAccessSecret): self
    {
        $this->cmAccessSecret = $cmAccessSecret;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
