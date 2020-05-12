<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BrochureRepository")
 * @Vich\Uploadable()
 */
class Brochure
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
    private $file;

    /**
     * @Vich\UploadableField(mapping="brochure", fileNameProperty="file")
     */
    private $fileFile;

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
        if(is_null($this->file)){
            $name = 'file';
            $this->setFile($name);
        }
        $this->fileFile = $fileFile;
    }


}
