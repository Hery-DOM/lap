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
        return $this->render('web/home.html.twig');

    }

}