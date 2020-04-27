<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramRepository")
 */
class Program
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_more;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $region;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typologie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $number_rooms;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surface;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $movie;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_delivery;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MainCriteria", inversedBy="programs")
     */
    private $main_criteria;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Criteria", inversedBy="programs")
     */
    private $criteria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProgramPicture", mappedBy="program")
     */
    private $program_picture;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Filter", inversedBy="programs")
     */
    private $filter;

    public function __construct()
    {
        $this->main_criteria = new ArrayCollection();
        $this->criteria = new ArrayCollection();
        $this->program_picture = new ArrayCollection();
        $this->filter = new ArrayCollection();
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

    public function getDescriptionMore(): ?string
    {
        return $this->description_more;
    }

    public function setDescriptionMore(?string $description_more): self
    {
        $this->description_more = $description_more;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getPostcode(): ?int
    {
        return $this->postcode;
    }

    public function setPostcode(?int $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTypologie(): ?string
    {
        return $this->typologie;
    }

    public function setTypologie(?string $typologie): self
    {
        $this->typologie = $typologie;

        return $this;
    }

    public function getNumberRooms(): ?int
    {
        return $this->number_rooms;
    }

    public function setNumberRooms(?int $number_rooms): self
    {
        $this->number_rooms = $number_rooms;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getMovie(): ?string
    {
        return $this->movie;
    }

    public function setMovie(?string $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    public function getDateDelivery(): ?\DateTimeInterface
    {
        return $this->date_delivery;
    }

    public function setDateDelivery(?\DateTimeInterface $date_delivery): self
    {
        $this->date_delivery = $date_delivery;

        return $this;
    }

    /**
     * @return Collection|MainCriteria[]
     */
    public function getMainCriteria(): Collection
    {
        return $this->main_criteria;
    }

    public function addMainCriterion(MainCriteria $mainCriterion): self
    {
        if (!$this->main_criteria->contains($mainCriterion)) {
            $this->main_criteria[] = $mainCriterion;
        }

        return $this;
    }

    public function removeMainCriterion(MainCriteria $mainCriterion): self
    {
        if ($this->main_criteria->contains($mainCriterion)) {
            $this->main_criteria->removeElement($mainCriterion);
        }

        return $this;
    }

    /**
     * @return Collection|Criteria[]
     */
    public function getCriteria(): Collection
    {
        return $this->criteria;
    }

    public function addCriterion(Criteria $criterion): self
    {
        if (!$this->criteria->contains($criterion)) {
            $this->criteria[] = $criterion;
        }

        return $this;
    }

    public function removeCriterion(Criteria $criterion): self
    {
        if ($this->criteria->contains($criterion)) {
            $this->criteria->removeElement($criterion);
        }

        return $this;
    }

    /**
     * @return Collection|ProgramPicture[]
     */
    public function getProgramPicture(): Collection
    {
        return $this->program_picture;
    }

    public function addProgramPicture(ProgramPicture $programPicture): self
    {
        if (!$this->program_picture->contains($programPicture)) {
            $this->program_picture[] = $programPicture;
            $programPicture->setProgram($this);
        }

        return $this;
    }

    public function removeProgramPicture(ProgramPicture $programPicture): self
    {
        if ($this->program_picture->contains($programPicture)) {
            $this->program_picture->removeElement($programPicture);
            // set the owning side to null (unless already changed)
            if ($programPicture->getProgram() === $this) {
                $programPicture->setProgram(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->name;

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

    /**
     * @return Collection|Filter[]
     */
    public function getFilter(): Collection
    {
        return $this->filter;
    }

    public function addFilter(Filter $filter): self
    {
        if (!$this->filter->contains($filter)) {
            $this->filter[] = $filter;
        }

        return $this;
    }

    public function removeFilter(Filter $filter): self
    {
        if ($this->filter->contains($filter)) {
            $this->filter->removeElement($filter);
        }

        return $this;
    }
}
