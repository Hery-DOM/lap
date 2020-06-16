<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramRepository")
 * @Vich\Uploadable()
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
     * @ORM\ManyToOne(targetEntity="App\Entity\ProgramCity", inversedBy="program")
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
     * @ORM\OneToMany(targetEntity="App\Entity\ProgramPicture", mappedBy="program", cascade={"remove"})
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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plan;

    /**
     * @Vich\UploadableField(mapping="plan", fileNameProperty="plan")
     */
    private $planFile;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\ProgramCategory", inversedBy="program")
     */
    private $programCategory;

    /**
     * @ORM\Column(type="text",  nullable=true)
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ProgramProperty", mappedBy="program", cascade={"remove"})
     */
    private $programProperties;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;


    public function __construct()
    {
        $this->main_criteria = new ArrayCollection();
        $this->criteria = new ArrayCollection();
        $this->program_picture = new ArrayCollection();
        $this->filter = new ArrayCollection();
        $this->plan = 'plan';
        $this->programProperties = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
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

    public function getPlan(): ?string
    {
        return $this->plan;
    }

    public function setPlan(?string $plan): self
    {
        $this->plan = $plan;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlanFile()
    {
        return $this->planFile;
    }

    /**
     * @param mixed $planFile
     */
    public function setPlanFile($planFile): void
    {
        if(is_null($this->plan)){
            $name = 'plan';
            $this->setPlan($name);
        }

        $this->planFile = $planFile;
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

    public function getProgramCategory(): ?ProgramCategory
    {
        return $this->programCategory;
    }

    public function setProgramCategory(?ProgramCategory $programCategory): self
    {
        $this->programCategory = $programCategory;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|ProgramProperty[]
     */
    public function getProgramProperties(): Collection
    {
        return $this->programProperties;
    }

    public function addProgramProperty(ProgramProperty $programProperty): self
    {
        if (!$this->programProperties->contains($programProperty)) {
            $this->programProperties[] = $programProperty;
            $programProperty->setProgram($this);
        }

        return $this;
    }

    public function removeProgramProperty(ProgramProperty $programProperty): self
    {
        if ($this->programProperties->contains($programProperty)) {
            $this->programProperties->removeElement($programProperty);
            // set the owning side to null (unless already changed)
            if ($programProperty->getProgram() === $this) {
                $programProperty->setProgram(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }




}
