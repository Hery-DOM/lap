<?php


namespace App\Controller;


use App\Repository\BlogArticleRepository;
use App\Repository\BlogCategoryRepository;
use App\Repository\BlogTextRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageBlogController extends PersonalClass
{
    /**
     * @Route("/blog/{cat}/{id}", name="blog_param")
     * @Route("/blog", name="blog")
     *
     * $cat is a parameter to know the category's name
     * $id is category's ID
     */
    public function blogHome(BlogCategoryRepository $blogCategoryRepository, Request $request, BlogArticleRepository
    $blogArticleRepository, $cat='default', $id=0, BlogTextRepository $blogTextRepository)
    {
        // get the blog's categories
        $categories = $blogCategoryRepository->findAll();

        // get blog's text
        $text = $blogTextRepository->findOneBy([]);

        // secure inputs
        $cat = $this->secureInput($cat);
        $id = $this->secureInput($id);
        $id = intval($id);

        // get the articles
        //if a category has been selected
        if($cat !== 'default'){
            if($id !== 0){
                // find the category
                $cat = $blogCategoryRepository->find($id);
                // find articles according with categoroy
                $articlesInit = $cat->getBlogArticles();
                // get the articles which are published
                $articles = [];
                foreach($articlesInit as $article){
                    if($article->getPublished()){
                        $articles[] = $article;
                    }
                }
            }else{
                return $this->redirectToRoute('blog');
            }
        }else{  // if there isn't a category selected
            $articlesInit = $blogArticleRepository->findBy([],['date'=>'DESC']);
            // get articles published
            $articles = [];
            foreach($articlesInit as $article){
                if($article->getPublished()){
                    $articles[] = $article;
                }
            }
        }


        // get the number of pages
        $allPages = ceil(count($articles)/5);

        // get 5 articles for one page
        // if it isn't the first page
        $page = 1;
        if($request->query->get('page')){
            // secure input
            $page = $this->secureInput($request->query->get('page'));
            $articles = $this->pageBlog($articles, $page);
        }else{ // if it's the first page
            $articles = $this->pageBlog($articles, $page);
        }

        // get 3 articles with the tag "top 3 vidéos"
        $topVideos = $blogArticleRepository->findByTag('top 3 vidéos');

        // get additionnal articles
        $addArticles = $blogArticleRepository->findByTag('articles complémentaires');


        return $this->render('web/blog.html.twig',[
            'categories' => $categories,
            'articles' => $articles,
            'text' => $text,
            'pages' => $allPages,
            'currentCatId' => $id,
            'currentCatName' => $cat,
            'currentPage' => $page,
            'topVideos' => $topVideos,
            'addArticles' => $addArticles
        ]);

    }

    /**
     * @Route("/blog/{cat}/{idCat}/{art}/{id}", name="blog_article")
     * $cat and $idCat are the category's name and ID
     * $art and $id are the article's name and ID
     */
    public function blogArticle($idCat, $art,$id, BlogArticleRepository $blogArticleRepository)
    {
        // secure inputs
        $idCat = $this->secureInput($idCat);
        $id = $this->secureInput($id);

        // get the article
        $article = $blogArticleRepository->find($id);

        // check : if article isn't published => back to blog
        if(!$article->getPublished()){
            return $this->redirectToRoute('blog');
        }

        // get 3 articles with the tag "top 3 vidéos"
        $topVideos = $blogArticleRepository->findByTag('top 3 vidéos');

        // get additionnal articles
        $addArticles = $blogArticleRepository->findByTag('articles complémentaires');

        return $this->render('web/blog_article.html.twig',[
            'article' => $article,
            'topVideos' => $topVideos,
            'addArticles' => $addArticles
        ]);
    }

}