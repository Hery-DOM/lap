<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageAlertMailController extends PersonalClass
{

    /**
     * @Route("/etre-alerte", name="alert")
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

        return $this->render('web/alert.html.twig');

    }

}