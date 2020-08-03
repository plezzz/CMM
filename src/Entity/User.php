<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\Column(type="datetime")
     */
    private $edited_on;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
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


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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
        return $this->edited_on;
    }

    public function setEditedOn(\DateTimeInterface $edited_on): self
    {
        $this->edited_on = $edited_on;

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

    public function setCmAccessToken(string $cmAccessToken): self
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
}
