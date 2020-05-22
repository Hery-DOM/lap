<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OwnerSubcategoryRepository")
 * @Vich\Uploadable()
 */
class OwnerSubcategory
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picto;

    /**
     * @Vich\UploadableField(mapping="owner", fileNameProperty="picto")
     */
    private $pictoFile;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OwnerArticle", mappedBy="owner_subcategory", cascade={"remove"})
     */
    private $ownerArticles;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OwnerCategory", inversedBy="ownerSubcategories")
     */
    private $owner_category;

    public function __construct()
    {
        $this->ownerArticles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicto(): ?string
    {
        return $this->picto;
    }

    public function setPicto(?string $picto): self
    {
        $this->picto = $picto;

        return $this;
    }

    /**
     * @return Collection|OwnerArticle[]
     */
    public function getOwnerArticles(): Collection
    {
        return $this->ownerArticles;
    }

    public function addOwnerArticle(OwnerArticle $ownerArticle): self
    {
        if (!$this->ownerArticles->contains($ownerArticle)) {
            $this->ownerArticles[] = $ownerArticle;
            $ownerArticle->setOwnerSubcategory($this);
        }

        return $this;
    }

    public function removeOwnerArticle(OwnerArticle $ownerArticle): self
    {
        if ($this->ownerArticles->contains($ownerArticle)) {
            $this->ownerArticles->removeElement($ownerArticle);
            // set the owning side to null (unless already changed)
            if ($ownerArticle->getOwnerSubcategory() === $this) {
                $ownerArticle->setOwnerSubcategory(null);
            }
        }

        return $this;
    }

    public function getOwnerCategory(): ?OwnerCategory
    {
        return $this->owner_category;
    }

    public function setOwnerCategory(?OwnerCategory $owner_category): self
    {
        $this->owner_category = $owner_category;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictoFile()
    {
        return $this->pictoFile;
    }

    /**
     * @param mixed $pictoFile
     */
    public function setPictoFile($pictoFile): void
    {
        $this->pictoFile = $pictoFile;
    }


}
