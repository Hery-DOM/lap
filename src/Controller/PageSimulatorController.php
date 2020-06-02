<?php


namespace App\Controller;


use App\Repository\SimulatorPtzRepository;
use App\Repository\ZoneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class PageSimulatorController extends PersonalClass
{

    private function getRevenueMax($ref)
    {
        switch ($ref){
            case "1A":
                return 37000;
                break;

            case "1B1":
                return 30000;
                break;

            case "1B2":
                return 27000;
                break;

            case "1C":
                return 34000;
                break;

            case "2A":
                return 51800;
                break;

            case "2B1":
                return 42000;
                break;

            case "2B2":
                return 37800;
                break;

            case "2C":
                return 33600;
                break;

            case "3A":
                return 62900;
                break;

            case "3B1":
                return 51000;
                break;

            case "3B2":
                return 45900;
                break;

            case "3C":
                return 40800;
                break;

            case "4A":
                return 74000;
                break;

            case "4B1":
                return 60000;
                break;

            case "4B2":
                return 54000;
                break;

            case "4C":
                return 48000;
                break;

            case "5A":
                return 85100;
                break;

            case "5B1":
                return 69000;
                break;

            case "5B2":
                return 62100;
                break;

            case "5C":
                return 55200;
                break;

            case "6A":
                return 96200;
                break;

            case "6B1":
                return 78000;
                break;

            case "6B2":
                return 70200;
                break;

            case "6C":
                return 62400;
                break;

            case "7A":
                return 107300;
                break;

            case "7B1":
                return 87000;
                break;

            case "7B2":
                return 78300;
                break;

            case "7C":
                return 69600;
                break;

            case "8A":
                return 118400;
                break;

            case "8B1":
                return 96000;
                break;

            case "8B2":
                return 86400;
                break;

            case "8C":
                return 76800;
                break;
        }

        return "Erreur sur la référence";
    }

    private function getCoastOprationMax($ref)
    {
        switch ($ref){
            case "1A":
                return 150000;
                break;

            case "1B1":
                return 135000;
                break;

            case "1B2":
                return 110000;
                break;

            case "1C":
                return 100000;
                break;

            case "2A":
                return 210000;
                break;

            case "2B1":
                return 189000;
                break;

            case "2B2":
                return 154000;
                break;

            case "2C":
                return 140000;
                break;

            case "3A":
                return 255000;
                break;

            case "3B1":
                return 230000;
                break;

            case "3B2":
                return 187000;
                break;

            case "3C":
                return 170000;
                break;

            case "4A":
                return 300000;
                break;

            case "4B1":
                return 270000;
                break;

            case "4B2":
                return 220000;
                break;

            case "4C":
                return 200000;
                break;

            case "5A":
                return 345000;
                break;

            case "5B1":
                return 311000;
                break;

            case "5B2":
                return 253000;
                break;

            case "5C":
                return 230000;
                break;
        }

        return "Erreur sur la référence";
    }


    /**
     * @Route("/simulateur-ptz", name="simulator")
     */
    public function simulator(Request $request, ZoneRepository $zoneRepository, SimulatorPtzRepository $simulatorPtzRepository)
    {

        // get texts
        $text = $simulatorPtzRepository->findOneBy(['name'=>'Textes']);
        $h1 = $text->getPagetitle();
        $metaTitle = $text->getMetatitle();
        $metaDescription = $text->getMetadescription();

        // is form is submitted
        if($request->isMethod('POST')){
            // secure inputs
            $owner = $this->secureInput($_POST['owner']);
            $city = $this->secureInput($_POST['city']);
            $family = $this->secureInput($_POST['family']);
            $operation = $this->secureInput($_POST['operation']);
            $revenue = $this->secureInput($_POST['revenue']);

            // check if user has been owner => not eligible
            if($owner == "true"){
               $result = "Non éligible";
                // save in session
                $session = new Session();
                $session->set('result',$result);
                $session->set('owner',$owner);
                $session->set('city',$city);
                $session->set('family',$family);
                $session->set('operation',$operation);
                $session->set('revenue',$revenue);
               return $this->redirectToRoute('simulator_result');
            }

            //check the zone of city
            $zoneCity = $zoneRepository->findOneBy(['city' => $city]);

            // get the resource maximum
            if($family >=8){
                $familyR = 8;
            }else{
                $familyR = $family;
            }
            $ref = $familyR.$zoneCity->getZone();
            $resourceMax = $this->getRevenueMax($ref);

            // if revenue > resource max => not eligible
            if($revenue > $resourceMax){
                $result = "Non éligible";
                // save in session
                $session = new Session();
                $session->set('result',$result);
                $session->set('owner',$owner);
                $session->set('city',$city);
                $session->set('family',$family);
                $session->set('operation',$operation);
                $session->set('revenue',$revenue);
                return $this->redirectToRoute('simulator_result');
            }

            // get the operation's coast max
            if($family >= 5){
                $familyO = 5;
            }else{
                $familyO = $family;
            }
            $refO = $familyO.$zoneCity->getZone();
            $coastMax = $this->getCoastOprationMax($refO);

            // if operation > coastMax => operation = coastMax
            if($operation >= $coastMax) {
                $operation = $coastMax;
            }

            // calculation : 40% of operation
            $result = $operation*0.4;
            // save in session
            $session = new Session();
            $session->set('result',$result);
            $session->set('owner',$owner);
            $session->set('city',$city);
            $session->set('family',$family);
            $session->set('operation',$operation);
            $session->set('revenue',$revenue);


            return $this->redirectToRoute('simulator_result');



        }


        return $this->render('web/simulator.html.twig',[
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);

    }


    /**
     * @Route("/simulateur-ptz-resultat", name="simulator_result")
     */
    public function simulatorResult(Request $request, SimulatorPtzRepository $simulatorPtzRepository)
    {
        $check = false;

        // get texts
        $text = $simulatorPtzRepository->findOneBy(['name'=>'Textes']);
        $h1 = $text->getPagetitle();
        $metaTitle = $text->getMetatitle();
        $metaDescription = $text->getMetadescription();


        // if there is already a session with name, email and phone
        $sessionOld = new Session();
        // secure the inputs from session
        $nameOld = $this->secureInput($sessionOld->get('name'));
        $emailOld = $this->secureInput($sessionOld->get('email'));
        $phoneOld = $this->secureInput($sessionOld->get('phone'));
        if($nameOld && $emailOld && $phoneOld){
            $check = true;
            $session = new Session();

            // create a session for name, email and phone
            $session->set('name',$nameOld);
            $session->set('email',$emailOld);
            $session->set('phone',$phoneOld);

            // prepare mail to admin
            $subject = "Simulateur PTZ";
            $from = $this->noreplyEmail();
            $to = $this->emailAdmin();
            $view = "email/simulator.html.twig";

            // secure the inputs from session
            $owner = $this->secureInput($session->get('owner'));
            $city = $this->secureInput($session->get('city'));
            $family = $this->secureInput($session->get('family'));
            $operation = $this->secureInput($session->get('operation'));
            $revenue = $this->secureInput($session->get('revenue'));
            $result = $this->secureInput($session->get('result'));


            $viewParam = [
                "owner" => $owner,
                "city" => $city,
                "family" => $family,
                "operation" => $operation,
                "revenue" => $revenue,
                "result" => $result,
                "name" => $nameOld,
                "email" => $emailOld,
                "phone" => $phoneOld
            ];

            $this->sendEmail($subject,$from,$to,$view,$viewParam);
            return $this->render('web/simulator_result.html.twig',[
                'check' => $check,
                "owner" => $owner,
                "city" => $city,
                "family" => $family,
                "operation" => $operation,
                "revenue" => $revenue,
                "result" => $result,
                "name" => $nameOld,
                "email" => $emailOld,
                "phone" => $phoneOld,
                'page' => '',
                'h1' => $h1,
                'title' => $metaTitle,
                'description' => $metaDescription
            ]);
        }



        if($request->isMethod('POST')){
            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])){
                // secure inputs
                $name = $this->secureInput($_POST['name']);
                $email = $this->secureInput($_POST['email']);
                $phone = $this->secureInput($_POST['phone']);

                if(!empty($name) && !empty($email) && !empty($phone)){

                    $check = true;
                    $session = new Session();

                    // create a session for name, email and phone
                    $session->set('name',$name);
                    $session->set('email',$email);
                    $session->set('phone',$phone);

                    // prepare mail to admin
                    $subject = "Simulateur PTZ";
                    $from = $this->noreplyEmail();
                    $to = $this->emailAdmin();
                    $view = "email/simulator.html.twig";

                    // secure the inputs from session
                    $owner = $this->secureInput($session->get('owner'));
                    $city = $this->secureInput($session->get('city'));
                    $family = $this->secureInput($session->get('family'));
                    $operation = $this->secureInput($session->get('operation'));
                    $revenue = $this->secureInput($session->get('revenue'));
                    $result = $this->secureInput($session->get('result'));


                    $viewParam = [
                        "owner" => $owner,
                        "city" => $city,
                        "family" => $family,
                        "operation" => $operation,
                        "revenue" => $revenue,
                        "result" => $result,
                        "name" => $name,
                        "email" => $email,
                        "phone" => $phone
                    ];

                    $this->sendEmail($subject,$from,$to,$view,$viewParam);
                    return $this->render('web/simulator_result.html.twig',[
                        'check' => $check,
                        "owner" => $owner,
                        "city" => $city,
                        "family" => $family,
                        "operation" => $operation,
                        "revenue" => $revenue,
                        "result" => $result,
                        "name" => $name,
                        "email" => $email,
                        "phone" => $phone,
                        'page' => '',
                        'h1' => $h1,
                        'title' => $metaTitle,
                        'description' => $metaDescription
                    ]);


                }


            }

        }


        return $this->render('web/simulator_result.html.twig',[
            'check' => $check,
            'page' => '',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);
    }

}