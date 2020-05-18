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
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
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
    public function pageSearch($array, $idNb){

        $idNb = $this->secureInput($idNb);

        //si l'idNb n'est pas un int
        if($idNb == 0){
            $idNb = 1;
        }
        //enlève 1 à l'indice de la page
        $idNb--;

        //récupération du début de la séquence pour array_slice
        $nbPage = $idNb*8;

        //récupération de 6 articles selon numéro de page
        $result = array_slice($array,$nbPage,8);
        return $result;
    }

    //pour récupérer le groupe d'articles à afficher sur une page
    public function pageBlog($array, $idNb){

        $idNb = $this->secureInput($idNb);

        //si l'idNb n'est pas un int
        if($idNb == 0){
            $idNb = 1;
        }
        //enlève 1 à l'indice de la page
        $idNb--;

        //récupération du début de la séquence pour array_slice
        $nbPage = $idNb*5;

        //récupération de 6 articles selon numéro de page
        $result = array_slice($array,$nbPage,5);
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


    public function getUrl(string $directory)
    {
        // secure $_SERVER
        $host = $this->secureInput($_SERVER['HTTP_HOST']);
        if($host == 'localhost'){
            $url = 'http://'.$host.'/'.$directory.'/public';
        }else{
            if(isset($_SERVER['HTTPS'])){
                // security
                $https = $this->secureInput($_SERVER['HTTPS']);
                if($https == "on"){
                    $url = "https://".$host;
                }else{
                    $url = "http://".$host;
                }
            }else{
                $url = "http://".$host;
            }
        }

        return $url;

    }



}