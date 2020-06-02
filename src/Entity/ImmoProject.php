<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImmoProjectRepository")
 */
class ImmoProject
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
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $pagetitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metatitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $metadescription;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPagetitle(): ?string
    {
        return $this->pagetitle;
    }

    public function setPagetitle(string $pagetitle): self
    {
        $this->pagetitle = $pagetitle;

        return $this;
    }

    public function getMetatitle(): ?string
    {
        return $this->metatitle;
    }

    public function setMetatitle(string $metatitle): self
    {
        $this->metatitle = $metatitle;

        return $this;
    }

    public function getMetadescription(): ?string
    {
        return $this->metadescription;
    }

    public function setMetadescription(?string $metadescription): self
    {
        $this->metadescription = $metadescription;

        return $this;
    }
}
