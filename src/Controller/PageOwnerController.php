<?php


namespace App\Controller;


use App\Repository\OwnerArticleRepository;
use App\Repository\OwnerCategoryRepository;
use App\Repository\OwnerHomeRepository;
use App\Repository\OwnerSubcategoryRepository;
use Symfony\Component\Routing\Annotation\Route;

class PageOwnerController extends PersonalClass
{
    /**
     * @Route("/devenir-proprietaire", name="owner_home")
     */
    public function ownerHome(OwnerCategoryRepository $ownerCategoryRepository, OwnerHomeRepository $ownerHomeRepository)
    {
        // get categories
        $cat = $ownerCategoryRepository->findAll();

        // get intro ans others texts
        $intro = $ownerHomeRepository->findOneBy(['name' => 'Introduction'])->getDescription();
        $h1 = $ownerHomeRepository->findOneBy(['name' => 'Titre de la page'])->getDescription();
        $metaTitle = $ownerHomeRepository->findOneBy(['name' => 'Balise title'])->getDescription();
        $metaDescription = $ownerHomeRepository->findOneBy(['name' => 'Meta description'])->getDescription();

        return $this->render('web/owner_home.html.twig',[
            'categories' => $cat,
            'intro' => $intro,
            'page' => 'proprietaire',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);

    }

    /**
     * @Route("/devenir-proprietaire/{slug}/{id}", name="owner_category")
     * $slug is the category's name
     * $id is the category's ID
     */
    public function ownerCategory($id, $slug, OwnerCategoryRepository $ownerCategoryRepository)
    {
        // secure the inputs
        $slug = $this->secureInput($slug);
        $id = $this->secureInput($id);

        // get every categories
        $categories = $ownerCategoryRepository->findAll();

        // get the category according with $id
        $cat = $ownerCategoryRepository->find($id);

        // get texts
        $h1 = $cat->getPagetitle();
        $metaTitle = $cat->getMetatitle();
        $metaDescription = $cat->getMetadescription();

        return $this->render('web/owner_category.html.twig',[
            'slug' => $slug,
            'cat' => $cat,
            'categories' => $categories,
            'page' => 'proprietaire',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);

    }

    /**
     * @Route("/devenir-proprietaire/{cat}/{idCat}/{slug}/{id}", name="owner_subcategory")
     * $slug is the subcategory's name
     * $id is the subcategory's name
     * $cat and $idCat are the category's name and category's ID
     */
    public function ownerSubCategory( $idCat, $slug, $id, OwnerSubcategoryRepository
    $ownerSubcategoryRepository, OwnerCategoryRepository $ownerCategoryRepository)
    {
        // secure the inputs
        $idCat = $this->secureInput($idCat);
        $slug = $this->secureInput($slug);
        $id = $this->secureInput($id);

        // get every categories
        $categories = $ownerCategoryRepository->findAll();

        // get current category
        $cat = $ownerCategoryRepository->find($idCat);

        // get the subcategory
        $subc = $ownerSubcategoryRepository->find($id);

        // get texts
        $h1 = $subc->getPagetitle();
        $metaTitle = $subc->getMetatitle();
        $metaDescription = $subc->getMetadescription();

        return $this->render('web/owner_subcategory.html.twig',[
            'currentCategory' => $cat,
            'categories' => $categories,
            'idCat' => $idCat,
            'slug' => $slug,
            'subcategory' => $subc,
            'page' => 'proprietaire',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);

    }

    /**
     * @Route("/devenir-proprietaire/{cat}/{idCat}/{subcat}/{idSubcat}/{slug}/{id}", name="owner_article")
     * $slug is the article's name
     * $id is the article's ID
     * $cat and $idCat are the category's name and ID
     * $subcat and $idSubcat are the subcategory's name and ID
     */
    public function ownerArticle($id, $idCat, $idSubcat, $slug, OwnerCategoryRepository $ownerCategoryRepository,
                                 OwnerSubcategoryRepository $ownerSubcategoryRepository, OwnerArticleRepository $ownerArticleRepository)
    {
        // secure the inputs
        $id = $this->secureInput($id);
        $idCat = $this->secureInput($idCat);
        $idSubcat = $this->secureInput($idSubcat);
        $slug = $this->secureInput($slug);

        // get every categories
        $categories = $ownerCategoryRepository->findAll();

        // get current category
        $currentCategory = $ownerCategoryRepository->find($idCat);

        // get current subcategory
        $currentSubCategory = $ownerSubcategoryRepository->find($idSubcat);

        // get the article
        $article = $ownerArticleRepository->find($id);

        // get texts
        $h1 = $article->getPagetitle();
        $metaTitle = $article->getMetatitle();
        $metaDescription = $article->getMetadescription();

        return $this->render('web/owner_article.html.twig',[
            'article' => $article,
            'currentCategory' => $currentCategory,
            'currentSubCategory' => $currentSubCategory,
            'slug' => $slug,
            'categories' => $categories,
            'page' => 'proprietaire',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);

    }

}