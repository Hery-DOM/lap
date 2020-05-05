<?php


namespace App\Controller;


use App\Entity\NewsletterTemp;
use App\Repository\HomepageRepository;
use App\Repository\NewsletterTempRepository;
use App\Repository\ProgramRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageHomeController extends PersonalClass
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request, EntityManagerInterface $entityManager, NewsletterTempRepository
    $newsletterTempRepository, HomepageRepository $homepageRepository, ProgramRepository $programRepository)
    {
        // get message in banner
        $banner = $homepageRepository->findOneBy(['name' => 'Bannière']);

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
                $test = $this->sendEmail('Inscription à la newsletter', 'noreply@lap.fr', 'contact@lap.fr',$view, $viewParam);
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


            // treatment for the search barre
        }


        return $this->render('web/home.html.twig',[
            'message' => $banner->getText(),
            'cities' => $cities,
            'typologies' => $typo
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
            $this->sendEmail('Inscription confirmée à la newsletter','noreply@lap.fr',$email,$view,$viewParam);

            // send a mail to administrator
            $viewAdmin = 'email/adminNewsletter.html.twig';
            $viewParamAdmin = [
                'name' => $emailsDB->getName(),
                'email' => $emailsDB->getEmail(),
                'city' => $emailsDB->getCity()
            ];
            $to = 'contact@lap.fr';
            $this->sendEmail('Nouvelle inscription confirmée à la newsletter', 'noreply@lap.fr',$to,$viewAdmin,
                $viewParamAdmin);

            // remove the user from newsletter_temp
            $entityManager->remove($emailsDB);
            $entityManager->flush();

            return $this->render('web/emailSentConfirm.html.twig');
        }

        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/ajax", name="ajax")
     * @IsGranted("ROLE_SUPER_ADMIN")
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




}