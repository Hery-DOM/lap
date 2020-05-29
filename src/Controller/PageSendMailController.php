<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageSendMailController extends PersonalClass
{

    /**
     * @Route("/etre-alerte", name="alert")
     * It's the alert from the program's page and search's page
     */
    public function alert(Request $request)
    {
        // when form is submitted
        if($request->isMethod('POST')){
            // secure inputs
            $name = $this->secureInput($_POST['name']);
            $phone = $this->secureInput($_POST['phone']);
            $email = $this->secureInput($_POST['email']);
            $city = $this->secureInput($_POST['city']);
            $typo = $this->secureInput($_POST['typo']);
            $priceMin = $this->secureInput($_POST['priceMin']);
            $priceMax = $this->secureInput($_POST['priceMax']);
            $surfaceMin = $this->secureInput($_POST['surfaceMin']);
            $surfaceMax = $this->secureInput($_POST['surfaceMax']);
            $rooms = $this->secureInput($_POST['rooms']);
            $handicap = $this->secureInput($_POST['handicap']);
            $delivery = $this->secureInput($_POST['delivery']);
            $prestations = $this->secureInput($_POST['prestations']);
            $comment = $this->secureInput($_POST['comment']);

            $subject = 'Contact pour être alerté du bien idéal';
            $from = 'noreply@locataireaproprietaire.fr';
            $view = 'email/alert.html.twig';
            $viewParam = [
              'name' => $name,
              'phone' => $phone,
              'email' => $email,
              'city' => $city,
              'typo' => $typo,
              'priceMin' => $priceMin,
              'priceMax' => $priceMax,
              'surfaceMin' => $surfaceMin,
              'surfaceMax' => $surfaceMax,
              'rooms' => $rooms,
              'handicap' => $handicap,
              'delivery' => $delivery,
              'prestations' => $prestations,
              'comment' => $comment
            ];

            $this->sendEmail($subject,$from,$this->emailAdmin(),$view, $viewParam);
            $this->addFlash('info', 'Votre demande a bien été prise en compte');
            return $this->redirectToRoute('alert');


        }

        return $this->render('web/alert.html.twig',[
            'page' => ''
        ]);

    }

    /**
     * @Route("/contact", name="contact")
     * To send a mail from contact mail in modal
     */
    public function contact()
    {
        // check : it isn't from form => redirect to homepage
        if(!isset($_POST['modal-form'])){
            return $this->redirectToRoute('home');
        }

        // secure inputs
        $name = $this->secureInput($_POST['modal-name']);
        $email = $this->secureInput($_POST['modal-email']);
        $phone = $this->secureInput($_POST['modal-phone']);
        $object = $this->secureInput($_POST['modal-object']);
        $message = $this->secureInput($_POST['modal-message']);

        $noreply = $this->noreplyEmail();
        $view = "email/contact.html.twig";
        $viewParam = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'object' => $object,
            'message' => $message
        ];

        // send the mail
        $this->sendEmail($object,$noreply,$this->emailAdmin(),$view,$viewParam);
        $this->addFlash('info','Merci, votre message a bien été envoyé');

        return $this->redirectToRoute('home');


    }

}