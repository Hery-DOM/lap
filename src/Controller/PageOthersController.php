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
use Symfony\Component\Routing\Annotation\Route;

class PageOthersController extends PersonalClass
{
    /**
     * @Route("/plan-du-site", name="sitemap")
     */
    public function sitemap(OwnerCategoryRepository $ownerCategoryRepository, BlogCategoryRepository $blogCategoryRepository)
    {
        // page "Devenir propriétaire"
        // get the categories => subcategories and articles
        $ownerCategories = $ownerCategoryRepository->findAll();


        // page "Blog"
        // get the categories => articles
        $blogCategories = $blogCategoryRepository->findAll();

        return $this->render('web/sitemap.html.twig',[
            'ownerCategories' => $ownerCategories,
            'blogCategories' => $blogCategories,
            'page' => ''
        ]);

    }

    /**
     * @Route("/politique-de-confidentialite", name="confidentiality")
     */
    public function confidentiality(ConfidentialityRepository $repository)
    {
        // get texts
        $text = $repository->findOneBy(['name'=>'Contenu']);
        $h1 = $repository->findOneBy(['name' => 'Titre de la page'])->getText();
        $metaTitle = $repository->findOneBy(['name' => 'Meta title'])->getText();
        $metaDescription = $repository->findOneBy(['name' => 'Meta description'])->getText();


        return $this->render('web/confidentiality.html.twig',[
            'text' => $text,
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);
    }


    /**
     * @Route("/mentions-legales", name="legal")
     */
    public function legal(LegalRepository $legalRepository)
    {
        // get texts
        $text = $legalRepository->findOneBy(['name' => 'Contenu']);
        $h1 = $legalRepository->findOneBy(['name' => 'Titre de la page'])->getText();
        $metaTitle = $legalRepository->findOneBy(['name' => 'Meta title'])->getText();
        $metaDescription = $legalRepository->findOneBy(['name' => 'Meta description'])->getText();

        return $this->render('web/legal.html.twig',[
            'text' => $text,
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);
    }

    /**
     * @Route("/rejoignez-notre-equipe", name="team")
     */
    public function team(TeamRepository $teamRepository)
    {

        // get text
        $text = $teamRepository->findOneBy([]);

        return $this->render('web/team.html.twig',[
            'text' => $text,
            'page' => ''
        ]);
    }

    /**
     * @Route("/lexique", name="lexique")
     */
    public function lexique(LexiqueRepository $repository)
    {
        // get texts
        $h1 = $repository->findOneBy(['name' => 'Titre de la page'])->getText();
        $title = $repository->findOneBy(['name' => 'Meta title'])->getText();
        $description = $repository->findOneBy(['name' => 'Meta description'])->getText();
        $text = $repository->findOneBy(['name' => 'Contenu'])->getText();

        return $this->render('web/lexique.html.twig',[
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
            'text' => $text
        ]);
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faq(FaqRepository $repository)
    {
        // get texts
        $h1 = $repository->findOneBy(['name' => 'Titre de la page'])->getText();
        $title = $repository->findOneBy(['name' => 'Meta title'])->getText();
        $description = $repository->findOneBy(['name' => 'Meta description'])->getText();
        $text = $repository->findOneBy(['name' => 'Contenu'])->getText();

        return $this->render('web/faq.html.twig',[
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
            'text' => $text
        ]);
    }

    /**
     * @Route("/parrainage", name="sponsor")
     */
    public function sponsor(SponsorRepository $repository)
    {
        // get texts
        $h1 = $repository->findOneBy(['name' => 'Titre de la page'])->getText();
        $title = $repository->findOneBy(['name' => 'Meta title'])->getText();
        $description = $repository->findOneBy(['name' => 'Meta description'])->getText();
        $text = $repository->findOneBy(['name' => 'Contenu'])->getText();

        return $this->render('web/sponsor.html.twig',[
            'h1' => $h1,
            'title' => $title,
            'description' => $description,
            'text' => $text
        ]);
    }

}