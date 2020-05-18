<?php


namespace App\Controller;


use App\Repository\BlogCategoryRepository;
use App\Repository\OwnerCategoryRepository;
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
            'blogCategories' => $blogCategories
        ]);

    }

    /**
     * @Route("/politique-de-confidentialite", name="confidentiality")
     */
    public function confidentiality()
    {
        return $this->render('web/confidentiality.html.twig');
    }


    /**
     * @Route("/mentions-legales", name="legal")
     */
    public function legal()
    {
        return $this->render('web/legal.html.twig');
    }

    /**
     * @Route("/rejoignez-notre-equipe", name="team")
     */
    public function team()
    {
        return $this->render('web/team.html.twig');
    }

}