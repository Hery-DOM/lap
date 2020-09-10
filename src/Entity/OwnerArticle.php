<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OwnerArticleRepository")
 * @Vich\Uploadable()
 */
class OwnerArticle
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="owner", fileNameProperty="picture")
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture_alt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\OwnerSubcategory", inversedBy="ownerArticles")
     */
    private $owner_subcategory;

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

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $essential;

    public function __toString()
    {
        return $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPictureAlt(): ?string
    {
        return $this->picture_alt;
    }

    public function setPictureAlt(?string $picture_alt): self
    {
        $this->picture_alt = $picture_alt;

        return $this;
    }

    public function getOwnerSubcategory(): ?OwnerSubcategory
    {
        return $this->owner_subcategory;
    }

    public function setOwnerSubcategory(?OwnerSubcategory $owner_subcategory): self
    {
        $this->owner_subcategory = $owner_subcategory;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    /**
     * @param mixed $pictureFile
     */
    public function setPictureFile($pictureFile): void
    {
        $this->pictureFile = $pictureFile;
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

    public function setMetadescription(string $metadescription): self
    {
        $this->metadescription = $metadescription;

        return $this;
    }

    public function getEssential(): ?string
    {
        return $this->essential;
    }

    public function setEssential(?string $essential): self
    {
        $this->essential = $essential;

        return $this;
    }


}
