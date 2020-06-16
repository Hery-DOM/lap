<?php


namespace App\Controller;


use App\Entity\NewsletterTemp;
use App\Repository\CriteriaRepository;
use App\Repository\HomepageBrochureRepository;
use App\Repository\HomepageRepository;
use App\Repository\NewsletterTempRepository;
use App\Repository\ProgramRepository;
use App\Repository\TestimonyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageHomeController extends PersonalClass
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request, EntityManagerInterface $entityManager, NewsletterTempRepository
    $newsletterTempRepository, HomepageRepository $homepageRepository, ProgramRepository $programRepository,
                         TestimonyRepository $testimonyRepository, CriteriaRepository $criteriaRepository,
                         HomepageBrochureRepository $homepageBrochureRepository)
    {
        // get message in banner
        $banner = $homepageRepository->findOneBy(['name' => 'Bannière']);

        // get Balise title, description and h1
        $h1 = $homepageRepository->findOneBy(['name' => 'Titre de la page'])->getText();
        $metaTitle = $homepageRepository->findOneBy(['name' => 'Balise title'])->getText();
        $metaDescription = $homepageRepository->findOneBy(['name' => 'Meta description'])->getText();

        // get every cities
        $homes = $programRepository->findBy([],['city' => 'ASC']);
        $cities = [];
        foreach($homes as $home){
            if(!in_array($home->getCity(),$cities)){
                $cities[] = $home->getCity();
            }
        }

        // get every typologies
        $typo = [];
        foreach($homes as $home){
            if(!in_array($home->getTypologie(),$typo)){
                $typo[] = $home->getTypologie();
            }
        }

        // get progams with filter "Sélection du mois"
        $programsSelection = $programRepository->findByFilter('Sélection du mois');

        // get every testimonies which are published
        $testimoniesInit = $testimonyRepository->findAll();
        $testimonies = [];
        foreach( $testimoniesInit as $value){
            if($value->getPublished()){
                $testimonies[] = $value;
            }
        }

        // get every crieteria with the name "prestations"
        $prestationsInit = $criteriaRepository->findBy(['name' => 'prestations']);

        // get url
        $url = $this->getUrl('projets-pro/lap');


        if($request->isMethod('POST')){
            // tretament for a newsletter
            if(isset($_POST['newsletter'])){
                // secure inputs
                $city = $this->secureInput($_POST['city']);
                $name = $this->secureInput($_POST['name']);
                $email = $this->secureInput($_POST['email']);

                $view = 'email/newsletter.html.twig';
                $viewParam = [
                  'city' => $city,
                  'name' => $name,
                    'email' => $email
                ];
                $test = $this->sendEmail('Inscription à la newsletter', $this->noreplyEmail(), $this->emailAdmin(),$view,
                    $viewParam);
                if($test){
                    // get every mail in newsletter_temp and check if there isn't already this mail
                    $emailDB = $newsletterTempRepository->findBy(['email' => $email]);
                    if(!$emailDB){
                        $temp = new NewsletterTemp();
                        $temp->setName($name);
                        $temp->setEmail($email);
                        $temp->setCity($city);
                        $entityManager->persist($temp);
                        $entityManager->flush();
                    }
                    return $this->render('web/emailSent.html.twig');
                }


            }

            // if form modal "brochure" is submitted
            if(isset($_POST['submit-brochure'])){
                // secure inputs
                $name = $this->secureInput($_POST['name']);
                $gender = $this->secureInput($_POST['gender']);
                $email = $this->secureInput($_POST['email']);
                $phone = $this->secureInput($_POST['phone']);
                $subject = "Formulaire pour télécharger un guide";
                $from = $this->noreplyEmail();
                $to = $this->emailAdmin();
                $view = "email/homepage_brochure.html.twig";
                $viewParam = [
                    'gender' => $gender,
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone
                ];
                $this->sendEmail($subject,$from,$to,$view,$viewParam);
                return $this->redirectToRoute('home');



            }



        }

        // get the brochures
        $brochures = $homepageBrochureRepository->findBy([], ['id' => 'ASC']);


        // get if cookies accepted
        $cookie = $request->cookies->get('cookieTime');
        $cookieBanner = true;
        if($cookie){
            $cookieBanner = false;
        }


        return $this->render('web/home.html.twig',[
            'message' => $banner->getText(),
            'cities' => $cities,
            'typologies' => $typo,
            'programSelection' => $programsSelection,
            'testimonies' => $testimonies,
            'url' => $url,
            'prestations' => $prestationsInit,
            'brochures' => $brochures,
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription,
            'cookieBanner' => $cookieBanner
        ]);
    }

    /**
     * @Route("/newsletter/confirm/{email}", name="newsletter_confirm")
     * To confirm a subscription to the newsletter
     */
    public function newsletterConfirm($email, NewsletterTempRepository $newsletterTempRepository,
                                      EntityManagerInterface $entityManager)
    {
        // secure $email
        $email = $this->secureInput($email);

        // get subscription by email and check if it exists
        $emailsDB = $newsletterTempRepository->findOneBy(['email' => $email]);
        if(!is_null($emailsDB)){
            // send a mail to user
            $view = 'email/confirmSubscription.html.twig';
            $viewParam = [
                'name' => $emailsDB->getName()
            ];
            $this->sendEmail('Inscription confirmée à la newsletter',$this->noreplyEmail(),$email,$view,
                $viewParam);

            // send a mail to administrator
            $viewAdmin = 'email/adminNewsletter.html.twig';
            $viewParamAdmin = [
                'name' => $emailsDB->getName(),
                'email' => $emailsDB->getEmail(),
                'city' => $emailsDB->getCity()
            ];
            $this->sendEmail('Nouvelle inscription confirmée à la newsletter', $this->noreplyEmail(),$this->emailAdmin(),
                $viewAdmin,
                $viewParamAdmin);

            // remove the user from newsletter_temp
            $entityManager->remove($emailsDB);
            $entityManager->flush();

            return $this->render('web/emailSentConfirm.html.twig',[
                'page' => ''
            ]);
        }

        return $this->redirectToRoute('home');

    }



    /********** AJAX *********/

    /**
     * @Route("/ajax", name="ajax")
     * No view
     */
    public function ajax(ProgramRepository $programRepository)
    {
        // get every cities
        $homes = $programRepository->findBy([],['city' => 'ASC']);
        $cities = [];
        foreach($homes as $home){
            // don't update if the city is already in array
            if(!in_array($home->getCity(),$cities)){
                $cities[] = $home->getCity();
            }

        }

        return new Response(json_encode($cities));

    }


    /**
     * @Route("/preview/load/{filter}",name="preview_load")
     */
    public function previewAjax($filter, ProgramRepository $programRepository)
    {
        // secure filter
        $filter = $this->secureInput($filter);

        // get programs accroding with filter
        $programs = $programRepository->findByFilter($filter);

        return $this->render('load/preview.html.twig',[
            'programs' => $programs
        ]);


    }


    /**
     * @Route("/cookie-ajax", name="cookie_ajax")
     * No view - AJAX
     */
    public function cookieAjax(Request $request)
    {
        // create a cookie
        $response = new Response();
        $response->headers->setCookie(Cookie::create('cookieTime','true',time()+3600*24*30));
        $response->prepare($request);
        $response->send();

        return new Response("true");
    }







}