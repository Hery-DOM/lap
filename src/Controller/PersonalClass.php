<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class PersonalClass extends AbstractController
{
    private $mailer;

    function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function emailAdmin()
    {
        return "contact@locataireaproprietaire.fr";
    }


    public function secureInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



    public function theLastest($array,$int)
    {
        // get the last position in the array
        $pos = count($array)-$int;
        if($pos < 0)
        {
            $pos = 0;
        }

        $result = array_slice($array, $pos);
        return $result;
    }

    // pour envoyer un mail
    public function sendEmail($subject, $from, $to,$view,$viewParam)
    {
        $mail = new \Swift_Message($subject);
        $mail->setFrom($from)
                ->setTo($to)
                ->setBody(
                    $this->renderView($view,$viewParam),
                    'text/html'
                );
        $send = $this->mailer->send($mail);

        return $send;
    }



    //pour récupérer le groupe d'articles à afficher sur une page
    public function pageBlog($array, $idNb){

        $idNb = $this->checkInput($idNb);

        //si l'idNb n'est pas un int
        if($idNb == 0){
            $idNb = 1;
        }
        //enlève 1 à l'indice de la page
        $idNb--;

        //récupération du début de la séquence pour array_slice
        $nbPage = $idNb*6;

        //récupération de 6 articles selon numéro de page
        $result = array_slice($array,$nbPage,6);
        return $result;
    }



    public function getIp()
    {
        if ( isset ( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        elseif ( isset ( $_SERVER['HTTP_CLIENT_IP'] ) )
        {
            $ip  = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }



    /********** A TESTER *************/


    public function pictureTreatment($entity, $picture, $param)
    {


        //To update picture
        /** @var UploadedFile $imageFile */
        $imageFile = $form[$picture]->getData();

        // if a picture is loaded
        if ($imageFile) {
            $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

            try {
                $move = $imageFile->move(
                    $this->getParameter($param),
                    $newFilename
                );

                if(!$move){
                    throw new FileException('Erreur lors du chargement de l\'image');
                }

            } catch (FileException $e) {
                // ... catch FileException $e
                return false.' '.$e->getMessage();
            }

            // if there is a picture => remove it from directory
            if(!is_null($entity->getPicture())){
                unlink("assets/img//".$entity->getPicture());
            }

            // Met à jour l'image pour stocker le nouveau nom de l'image
            $entity->setPicture($newFilename);

            return true;
        }

        return null;
    }

}