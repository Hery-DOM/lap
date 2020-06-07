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
        $picture = $aboutPictureRepository->findOneBy([]);
        $reasons = $aboutWhyRepository->findBy([],['list_order'=>'ASC']);
        $sections['Qui sommes nous'] = $aboutRepository->findOneBy(['name' => 'Qui sommes nous']);
        $sections['Phrase dans bandeau'] = $aboutRepository->findOneBy(['name' => 'Phrase dans bandeau']);
        $sections['Notre communication'] = $aboutRepository->findOneBy(['name' => 'Notre communication']);
        $sections['Nos différents réseaux'] = $aboutRepository->findOneBy(['name' => 'Nos différents réseaux']);
        // get Balise title, description and h1
        $h1 = $aboutRepository->findOneBy(['name' => 'Titre de la page'])->getText();
        $metaTitle = $aboutRepository->findOneBy(['name' => 'Balise title'])->getText();
        $metaDescription = $aboutRepository->findOneBy(['name' => 'Meta description'])->getText();

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
            'testimonies' => $testimonies,
            'page' => 'nous',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);


    }

}