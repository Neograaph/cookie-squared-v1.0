<?php

namespace App\Entity;

use App\Repository\CustomRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomRepository::class)
 */
class Custom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="customs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_site;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="boolean")
     */
    private $refuse_button;

    /**
     * @ORM\Column(type="integer")
     */
    private $layout;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getRefuseButton(): ?bool
    {
        return $this->refuse_button;
    }

    public function setRefuseButton(bool $refuse_button): self
    {
        $this->refuse_button = $refuse_button;

        return $this;
    }

    public function getLayout(): ?int
    {
        return $this->layout;
    }

    public function setLayout(int $layout): self
    {
        $this->layout = $layout;

        return $this;
    }
}
