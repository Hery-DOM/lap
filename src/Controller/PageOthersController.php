<?php


namespace App\Controller;


use App\Repository\BlogCategoryRepository;
use App\Repository\ConfidentialityRepository;
use App\Repository\LegalRepository;
use App\Repository\OwnerCategoryRepository;
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

}