<?php


namespace App\Controller;


use Symfony\Component\Routing\Annotation\Route;

class PageHomeController extends PersonalClass
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        // get message in banner

        return $this->render('web/home.html.twig',[
            'message' => ''
        ]);
    }



}