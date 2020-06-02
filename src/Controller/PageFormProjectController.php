<?php


namespace App\Controller;


use App\Repository\ImmoProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageFormProjectController extends PersonalClass
{
    /**
     * @Route("/projet", name="project")
     */
    public function project(Request $request, ImmoProjectRepository $repository)
    {

        // get texts
        $text = $repository->findOneBy(['name'=>'Textes']);
        $h1 = $text->getPagetitle();
        $metaTitle = $text->getMetatitle();
        $metaDescription = $text->getMetadescription();

        // if form is submitted
        if($request->isMethod('POST')){
            // secure inputs + param
            $param = [];
            $param['situation'] = $this->secureInput($_POST['situation']);
            $param['search'] = $this->secureInput($_POST['search']);
            for($i=1; $i<=5; $i++){
                if(isset($_POST['T'.$i])){
                    $name = 'T'.$i;
                    $param[$name] = $this->secureInput($_POST['T'.$i]);
                }
            }
            $param['budget'] = $this->secureInput($_POST['budget']);
            $param['pro'] = $this->secureInput($_POST['pro']);
            $param['buy'] = $this->secureInput($_POST['buy']);
            $param['ville'] = $this->secureInput($_POST['ville']);
            $param['delai'] = $this->secureInput($_POST['delai']);
            $param['autres'] = $this->secureInput($_POST['autres']);
            $param['firstname'] = $this->secureInput($_POST['firstname']);
            $param['lastname'] = $this->secureInput($_POST['lastname']);
            $param['email'] = $this->secureInput($_POST['email']);
            $param['phone'] = $this->secureInput($_POST['phone']);
            $param['contact'] = $this->secureInput($_POST['contact']);

            $subject = "Projet d'un prospect";
            $from = $this->noreplyEmail();
            $to = $this->emailAdmin();
            $view = "email/project.html.twig";

            $this->sendEmail($subject, $from, $to, $view, $param);

            return $this->redirectToRoute('project_after');



        }

        return $this->render('web/project.html.twig',[
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);
    }


    /**
     * @Route("/merci", name="project_after")
     */
    public function projectAfter(ImmoProjectRepository $repository)
    {
        // get texts
        $text = $repository->findOneBy(['name'=>'Textes']);
        $h1 = $text->getPagetitle();
        $metaTitle = $text->getMetatitle();
        $metaDescription = $text->getMetadescription();

        return $this->render('web/project_after.html.twig',[
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);
    }

}