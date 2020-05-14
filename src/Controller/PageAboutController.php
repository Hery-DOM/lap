<?php


namespace App\Controller;


use App\Repository\AboutPictureRepository;
use App\Repository\AboutRepository;
use App\Repository\AboutWhyRepository;
use App\Repository\TestimonyRepository;
use Symfony\Component\Routing\Annotation\Route;

class PageAboutController extends PersonalClass
{
    /**
     * @Route("/qui-sommes-nous", name="about")
     */
    public function about(AboutRepository $aboutRepository, AboutPictureRepository $aboutPictureRepository,
                          AboutWhyRepository $aboutWhyRepository, TestimonyRepository $testimonyRepository)
    {
        // get the sections for text and movie + get the picture + get the reasons
        $sections = $aboutRepository->findBy([],['section' => 'ASC']);
        $picture = $aboutPictureRepository->findOneBy([]);
        $reasons = $aboutWhyRepository->findBy([],['list_order'=>'ASC']);

        // get every testimonies which are published
        $testimoniesInit = $testimonyRepository->findAll();
        $testimonies = [];
        foreach( $testimoniesInit as $value){
            if($value->getPublished()){
                $testimonies[] = $value;
            }
        }

        return $this->render('web/about.html.twig',[
            'sections' => $sections,
            'picture' => $picture,
            'reasons' => $reasons,
            'testimonies' => $testimonies
        ]);


    }

}