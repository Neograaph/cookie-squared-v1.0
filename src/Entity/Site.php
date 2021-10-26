<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $scan_at;

    /**
     * @ORM\Column(type="string", length=9999, nullable=true)
     */
    private $cookie_list;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
        $this->scan_at = NULL;
        $this->cookie_list = NULL;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOwner(): ?User
    {
        return $this->id_owner;
    }

    public function setIdOwner(?User $id_owner): self
    {
        $this->id_owner = $id_owner;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getScanAt(): ?\DateTimeImmutable
    {
        return $this->scan_at;
    }

    public function setScanAt(?\DateTimeImmutable $scan_at): self
    {
        $this->scan_at = $scan_at;

        return $this;
    }

    public function getCookieList(): ?string
    {
        return $this->cookie_list;
    }

    public function setCookieList(?string $cookie_list): self
    {
        $this->cookie_list = $cookie_list;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
