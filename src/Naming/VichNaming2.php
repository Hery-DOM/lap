<?php

namespace App\Naming;

use Vich\UploaderBundle\Mapping\PropertyMapping;
use Vich\UploaderBundle\Naming\NamerInterface;

class VichNaming2 implements NamerInterface
{

    /**
     * Creates a name for the file being uploaded.
     *
     * @param object $object The object the upload is attached to
     * @param PropertyMapping $mapping The mapping to use to manipulate the given object
     *
     * @return string The file name
     */
    public function name($object, PropertyMapping $mapping): string
    {
        // get picture's name
        $name = 'file';
        $mime = $mapping->getFile($object)->getMimeType();

        switch ($mime){
            case "image/jpeg":
                $ext = "jpeg";
                break;

            case "image/jpg":
                $ext = "jpg";
                break;

            case "image/png":
                $ext = "png";
                break;

            case "application/pdf":
                $ext = "pdf";
                break;
        }

        // secure name and add uniq ID
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $name);
        $newFilename = $safeFilename . '-' . uniqid(). '.'.$ext;

        return $newFilename;
    }
}
