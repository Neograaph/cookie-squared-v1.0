<?php

namespace App\Entity;

use App\Repository\ScraperRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScraperRepository::class)
 */
class Scraper
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="scrapers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_site;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIdSite(): ?Site
    {
        return $this->id_site;
    }

    public function setIdSite(?Site $id_site): self
    {
        $this->id_site = $id_site;

        return $this;
    }
}
