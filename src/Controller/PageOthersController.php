<?php


namespace App\Controller;


use App\Repository\BlogCategoryRepository;
use App\Repository\ConfidentialityRepository;
use App\Repository\FaqRepository;
use App\Repository\LegalRepository;
use App\Repository\LexiqueRepository;
use App\Repository\OwnerCategoryRepository;
use App\Repository\SponsorRepository;
use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageOthersController extends PersonalClass
{
    /**
     * @Route("/plan-du-site", name="sitemap")
     */
    public function sitemap(OwnerCategoryRepository $ownerCategoryRepository, BlogCategoryRepository
    $blogCategoryRepository, Request $request)
    {
        // page "Devenir propriétaire"
        // get the categories => subcategories and articles
        $ownerCategories = $ownerCategoryRepository->findAll();


        // page "Blog"
        // get the categories => articles
        $blogCategories = $blogCategoryRepository->findAll();

        // get if cookies accepted
        $cookie = $request->cookies->get('cookieTime');
        $cookieBanner = true;
        if($cookie){
            $cookieBanner = false;
        }

        return $this->render('web/sitemap.html.twig',[
            'ownerCategories' => $ownerCategories,
            'blogCategories' => $blogCategories,
            'page' => '',
            'cookieBanner' => $cookieBanner
        ]);

    }

    /**
     * @Route("/politique-de-confidentialite", name="confidentiality")
     */
    public function confidentiality(ConfidentialityRepository $repository, Request $request)
    {
        // get texts
        $text = $repository->findOneBy(['name'=>'Contenu']);
        $h1 = $repository->findOneBy(['name' => 'Titre de la page'])->getText();
        $metaTitle = $repository->findOneBy(['name' => 'Balise title'])->getText();
        $metaDescription = $repository->findOneBy(['name' => 'Meta description'])->getText();

        // get if cookies accepted
        $cookie = $request->cookies->get('cookieTime');
        $cookieBanner = true;
        if($cookie){
            $cookieBanner = false;
        }

        return $this->render('web/confidentiality.html.twig',[
            'text' => $text,
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription,
            'cookieBanner' => $cookieBanner
        ]);
    }


    /**
     * @Route("/mentions-legales", name="legal")
     */
    public function legal(LegalRepository $legalRepository, Request $request)
    {
        // get texts
        $text = $legalRepository->findOneBy(['name' => 'Contenu']);
        $h1 = $legalRepository->findOneBy(['name' => 'Titre de la page'])->getText();
        $metaTitle = $legalRepository->findOneBy(['name' => 'Balise title'])->getText();
        $metaDescription = $legalRepository->findOneBy(['name' => 'Meta description'])->getText();

        // get if cookies accepted
        $cookie = $request->cookies->get('cookieTime');
        $cookieBanner = true;
        if($cookie){
            $cookieBanner = false;
        }

        return $this->render('web/legal.html.twig',[
            'text' => $text,
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription,
            'cookieBanner' => $cookieBanner
        ]);
    }

    /**
     * @Route("/rejoignez-notre-equipe", name="team")
     */
    public function team(TeamRepository $teamRepository, Request $request)
    {

        // get texts
        $text = $teamRepository->findOneBy(['name' => 'Contenu'])->getText();
        $h1 = $teamRepository->findOneBy(['name' => 'Titre de la page'])->getText();
        $metaTitle = $teamRepository->findOneBy(['name' => 'Balise title'])->getText();
        $metaDescription = $teamRepository->findOneBy(['name' => 'Meta description'])->getText();

        // get if cookies accepted
        $cookie = $request->cookies->get('cookieTime');
        $cookieBanner = true;
        if($cookie){
            $cookieBanner = false;
        }

        return $this->render('web/team.html.twig',[
            'text' => $text,
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription,
            'cookieBanner' => $cookieBanner
        ]);
    }

    /**
     * @Route("/lexique", name="lexique")
     */
    public function lexique(LexiqueRepository $repository, Request $request)
    {
        // get texts
        $h1 = $repository->findOneBy(['name' => 'Titre de la page'])->getText();
        $title = $repository->findOneBy(['name' => 'Balise title'])->getText();
        $description = $repository->findOneBy(['name' => 'Meta description'])->getText();
        $text = $repository->findOneBy(['name' => 'Contenu'])->getText();

        // get if cookies accepted
        $cookie = $request->cookies->get('cookieTime');
        $cookieBanner = true;
        if($cookie){
            $cookieBanner = false;
        }

        return $this->render('web/lexique.html.twig',[
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
            'text' => $text,
            'cookieBanner' => $cookieBanner
        ]);
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faq(FaqRepository $repository, Request $request)
    {
        // get texts
        $h1 = $repository->findOneBy(['name' => 'Titre de la page'])->getText();
        $title = $repository->findOneBy(['name' => 'Balise title'])->getText();
        $description = $repository->findOneBy(['name' => 'Meta description'])->getText();
        $text = $repository->findOneBy(['name' => 'Contenu'])->getText();

        // get if cookies accepted
        $cookie = $request->cookies->get('cookieTime');
        $cookieBanner = true;
        if($cookie){
            $cookieBanner = false;
        }

        return $this->render('web/faq.html.twig',[
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
            'text' => $text,
            'cookieBanner' => $cookieBanner
        ]);
    }

    /**
     * @Route("/parrainage", name="sponsor")
     */
    public function sponsor(SponsorRepository $repository, Request $request)
    {
        // get texts
        $h1 = $repository->findOneBy(['name' => 'Titre de la page'])->getText();
        $title = $repository->findOneBy(['name' => 'Balise title'])->getText();
        $description = $repository->findOneBy(['name' => 'Meta description'])->getText();
        $text = $repository->findOneBy(['name' => 'Contenu'])->getText();

        // get if cookies accepted
        $cookie = $request->cookies->get('cookieTime');
        $cookieBanner = true;
        if($cookie){
            $cookieBanner = false;
        }

        return $this->render('web/sponsor.html.twig',[
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
            'text' => $text,
            'cookieBanner' => $cookieBanner
        ]);
    }

}