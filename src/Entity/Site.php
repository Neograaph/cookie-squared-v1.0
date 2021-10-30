<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Cookie::class, mappedBy="id_site", orphanRemoval=true)
     */
    private $cookies;

    /**
     * @ORM\OneToMany(targetEntity=Custom::class, mappedBy="id_site", orphanRemoval=true)
     */
    private $customs;

    public function __construct()
    {
        $this->created_at = new DateTimeImmutable();
        $this->scan_at = NULL;
        $this->cookie_list = NULL;
        $this->cookies = new ArrayCollection();
        $this->customs = new ArrayCollection();
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

    /**
     * @return Collection|Cookie[]
     */
    public function getCookies(): Collection
    {
        return $this->cookies;
    }

    public function addCookie(Cookie $cookie): self
    {
        if (!$this->cookies->contains($cookie)) {
            $this->cookies[] = $cookie;
            $cookie->setIdSite($this);
        }

        return $this;
    }

    public function removeCookie(Cookie $cookie): self
    {
        if ($this->cookies->removeElement($cookie)) {
            // set the owning side to null (unless already changed)
            if ($cookie->getIdSite() === $this) {
                $cookie->setIdSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Custom[]
     */
    public function getCustoms(): Collection
    {
        return $this->customs;
    }

    public function addCustom(Custom $custom): self
    {
        if (!$this->customs->contains($custom)) {
            $this->customs[] = $custom;
            $custom->setIdSite($this);
        }

        return $this;
    }

    public function removeCustom(Custom $custom): self
    {
        if ($this->customs->removeElement($custom)) {
            // set the owning side to null (unless already changed)
            if ($custom->getIdSite() === $this) {
                $custom->setIdSite(null);
            }
        }

        return $this;
    }
}
