<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HomepageBrochureRepository")
 * @Vich\Uploadable()
 */
class HomepageBrochure
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
    private $file='file';

    /**
     * @Vich\UploadableField(mapping="brochure", fileNameProperty="file")
     */
    private $fileFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(?string $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileFile()
    {
        return $this->fileFile;
    }

    /**
     * @param mixed $fileFile
     */
    public function setFileFile($fileFile): void
    {
        $this->fileFile = $fileFile;
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
