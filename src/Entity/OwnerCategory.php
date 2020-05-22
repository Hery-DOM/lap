<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OwnerCategoryRepository")
 * @Vich\Uploadable()
 */
class OwnerCategory
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
     * @ORM\OneToMany(targetEntity="App\Entity\OwnerSubcategory", mappedBy="owner_category", cascade={"remove"})
     */
    private $ownerSubcategories;

    public function __construct()
    {
        $this->ownerSubcategories = new ArrayCollection();
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
     * @return Collection|OwnerSubcategory[]
     */
    public function getOwnerSubcategories(): Collection
    {
        return $this->ownerSubcategories;
    }

    public function addOwnerSubcategory(OwnerSubcategory $ownerSubcategory): self
    {
        if (!$this->ownerSubcategories->contains($ownerSubcategory)) {
            $this->ownerSubcategories[] = $ownerSubcategory;
            $ownerSubcategory->setOwnerCategory($this);
        }

        return $this;
    }

    public function removeOwnerSubcategory(OwnerSubcategory $ownerSubcategory): self
    {
        if ($this->ownerSubcategories->contains($ownerSubcategory)) {
            $this->ownerSubcategories->removeElement($ownerSubcategory);
            // set the owning side to null (unless already changed)
            if ($ownerSubcategory->getOwnerCategory() === $this) {
                $ownerSubcategory->setOwnerCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getpictoFile()
    {
        return $this->pictoFile;
    }

    /**
     * @param mixed $pictoFile
     */
    public function setpictoFile($pictoFile): void
    {
        /*if(is_null($this->picto)){
            $name = 'owner';
            $this->setPicto($name);
        }*/
        $this->pictoFile = $pictoFile;
    }


}
