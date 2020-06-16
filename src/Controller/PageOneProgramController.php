<?php


namespace App\Controller;


use App\Repository\ProgramPictureRepository;
use App\Repository\ProgramRepository;
use App\Repository\SearchBrochureRepository;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageOneProgramController extends PersonalClass
{

    public function escapeAccents($string)
    {
        $string = strtolower($string);
        $strAccent = "à,à,á,â,à,ä,å,ò,ó,ô,õ,ö,è,é,ê,ë,ì,í,î,ï,ù,ú,û,ü,ÿ";
        $arrayAccent = explode(',',$strAccent);
        $strLetter = "aaaaaaaoooooeeeeeiiiiuuuuy";
        $arrayLetter = str_split($strLetter);

        foreach($arrayAccent as $key => $accent){
           $string =  str_replace($accent, $arrayLetter[$key],$string);
        }
        return $string;

    }


    /**
     * @Route("/programmes-neufs/{id}/{city}/{slug}", name="program")
     * $id is program's ID
     */
    public function oneProgram($id, ProgramRepository $programRepository, $slug, SearchBrochureRepository $searchBrochureRepository)
    {
        // secure $id ang get program
        $id = $this->secureInput($id);
        $program = $programRepository->find($id);
        $slug = $this->secureInput($slug);

        // get brochure
        $brochure = $searchBrochureRepository->findOneBy([]);

        // if user has sent the form modal
        if(isset($_POST['search-modal'])){
            // build the mail
            $subject = "Formulaire d'un programme ";
            $email = $this->secureInput($_POST['email']);
            $name = $this->secureInput($_POST['name']);
            $phone = $this->secureInput($_POST['phone']);
            $gender = $this->secureInput($_POST['gender']);
            $programMail = $program->getName();
            $view = "email/contact_search.html.twig";
            $viewParam = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'program' => $programMail,
                'gender' => $gender
            ];
            $message = $this->sendEmail($subject, $this->noreplyEmail(), $this->emailAdmin(),
                $view,$viewParam);
            $this->addFlash('info', 'Merci, vous serez recontacté prochainement');

            // to send the PDF
            $path = dirname(__DIR__,2).'/public/assets/img/brochure/';
            $file = $path.$brochure->getFile();

            $response = new BinaryFileResponse($file);

            return $response;
            /*$this->downloadFile($brochure->getFile());
            return $this->redirectToRoute('program',[
                'slug' => $slug,
                'id' => $id
            ]);*/
        }

        // initialize $form
        $form = [
            'city' => '',
            'typo' => '',
            'priceMin' => '',
            'priceMax' => '',
            'surfaceMin' => '',
            'surfaceMax' => '',
            'handicap' => '',
            'rooms' => [],
            'disponibility' => [],
            'prestations' => [],
            'othersCriteria' => []
        ];

        // get slug
        if(isset($_POST['slug'])){
            $slug = $this->secureInput($_POST['slug']);
        }else{
            $slug = 'bordeaux-metropole';
        }

        if(isset($_POST['city'])){
            $form['city'] = $this->secureInput($_POST['city']);
        }
        if(isset($_POST['typo'])){
            $form['typo'] = $this->secureInput($_POST['typo']);
        }
        if(isset($_POST['priceMin'])){
            $form['priceMin'] = $this->secureInput($_POST['priceMin']);
        }
        if(isset($_POST['priceMax'])){
            $form['priceMax'] = $this->secureInput($_POST['priceMax']);
        }
        if(isset($_POST['surfaceMin'])){
            $form['surfaceMin'] = $this->secureInput($_POST['surfaceMin']);
        }
        if(isset($_POST['surfaceMax'])){
            $form['surfaceMax'] = $this->secureInput($_POST['surfaceMax']);
        }
        if(isset($_POST['handicap'])){
            $form['handicap'] = $this->secureInput($_POST['handicap']);
        }
        foreach($_POST as $key => $value){
            if(preg_match('#^rooms-#',$key)){
                $form['rooms'][$key] = $key;
                $rooms[] = substr($key,6);
            }

            if(preg_match('#^prestations-#',$key)){
                $form['prestations'][$key] = $key;
                $prestations[] = substr($key,12);
            }

            if(preg_match('#disponibility-#',$key)){
                $form['disponibility'][$key] = $key;
                $disponibilty[] = substr($key, 14);
            }

            if(preg_match('#others-#', $key)){
                $form['others'][$key] = $key;
                $othersCriteria[] = substr($key,7);
            }
        }

        // get geolocalisation
        $address = $program->getAddress();
        $city = $program->getCity();
        $postcode = $program->getPostcode();
        $fullAddress = '';
        if(!empty($address)){
            $fullAddress .= $address.' ';
        }
        if(!empty($postcode)){
            $fullAddress .= $postcode.' ';
        }
        if(!empty($city)){
            $fullAddress .= $city;
        }
        $fullAddress = $this->escapeAccents($fullAddress);
        $fullAddress = str_replace(' ','+',$fullAddress);

        if(is_null($fullAddress) || empty($fullAddress)){
            $local_latitude = '';
            $local_longitude = '';
        }else{
            $geocoder = "https://api-adresse.data.gouv.fr/search/?q=".$fullAddress;

            $result = json_decode(file_get_contents($geocoder));

            $local_latitude = $result->features[0]->geometry->coordinates[1];
            $local_longitude = $result->features[0]->geometry->coordinates[0];

        }









        // get two others programs according with criteria
        // first step : by repo
        $lastPrograms = $programRepository->findBySearch($form['city'],$form['typo'],$form['priceMin'],$form['priceMax'],$form['surfaceMin'],$form['surfaceMax'],$form['handicap']);

        // second : get the programs with the the criteria rooms, disponibility, prestation and others
        // ROOMS
        if(!empty($form['rooms'])){
            $temp = [];
            foreach($lastPrograms as $program){
                foreach($form['rooms'] as $room){
                    if($room == $program->getNumberRooms()){
                        $temp[] = $program;
                        break;
                    }
                    if($room == 6){
                        if($program->getNumberRooms() > 6){
                            $temp[] = $program;
                            break;
                        }
                    }
                }
            }

            // reinitialize + save in $programs
            $lastPrograms = [];
            $lastPrograms = $temp;
            $temp = [];
        }


        // DISPONIBILTY
        if(!empty($form['disponibility'])){
            $temp = [];
            foreach($lastPrograms as $program){
                foreach($form['disponibility'] as $dispo){
                    $now = new \DateTimeImmutable('now');

                    switch ($dispo){
                        case "immediatly":
                            if($program->getDateDelivery() <= $now){
                                $temp[] = $program;
                            }
                            break;

                        case "0":
                            if($program->getDateDelivery()->format('Y') == $now->format('Y')){
                                $temp[] = $program;
                            }
                            break;

                        case "1":
                            $year1 = intval($now->format('Y'))+1;
                            if($program->getDateDelivery()->format('Y') == $year1){
                                $temp[] = $program;
                            }
                            break;

                        case "2":
                            $year2 = intval($now->format('Y'))+2;
                            if($program->getDateDelivery()->format('Y') >= $year2){
                                $temp[] = $program;
                            }
                            break;
                    }
                }
            }
            // reinitialize + save in $programs
            $lastPrograms = [];
            $lastPrograms = $temp;
            $temp = [];
        }

        // PRESTATIONS
        if(!empty($form['prestations'])){
            $temp = [];
            foreach($lastPrograms as $program){

                foreach($form['prestations'] as $prestation){
                    foreach($program->getCriteria() as $criteria){
                        if($criteria->getName() == 'Prestations'){
                            if(stripos(strtolower($criteria->getCriteriaOption()), $prestation) !== false){
                                $temp[] = $program;
                            }

                        }
                    }
                }
            }
            // reinitialize + save in $programs
            $lastPrograms = [];
            $lastPrograms = $temp;
            $temp = [];

        }

        // get 3 last programs (in twig, to escape the current with a condition in twig)
        $lastPrograms = $this->theLastest($lastPrograms, 3);

        // get texts
        $h1 = $program->getPagetitle();
        $metaTitle = $program->getMetatitle();
        $metaDescription = $program->getMetadescription();


        // if form modal "plan" is submitted
        if(isset($_POST['submit-plan'])){
            // secure inputs
            $name = $this->secureInput($_POST['name']);
            $gender = $this->secureInput($_POST['gender']);
            $email = $this->secureInput($_POST['email']);
            $phone = $this->secureInput($_POST['phone']);
            $progPlan = $program->getName();
            $subject = "Formulaire d'un programme";
            $from = $this->noreplyEmail();
            $to = $this->emailAdmin();
            $view = "email/program_plan.html.twig";
            $viewParam = [
                'gender' => $gender,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'program' => $progPlan
            ];
            $this->sendEmail($subject,$from,$to,$view,$viewParam);
            $this->addFlash('info','Merci, vous serez recontacté prochainement');
            return $this->redirectToRoute('program',[
                'slug' => $slug,
                'id' => $id
            ]);



        }

        return $this->render('web/program.html.twig',[
            'program' => $program,
            'form' => $form,
            'slug' => $slug,
            'latitude' => $local_latitude,
            'longitude' => $local_longitude,
            'lastPrograms' => $lastPrograms,
            'brochure' => $brochure,
            'page' => 'logement',
            'h1' => $h1,
            'title' => $metaTitle,
            'description' => $metaDescription
        ]);

    }


    /**
     * @Route("/programmes-neufs/programme-photo/{id}", name="program_picture")
     * It's for a load page
     * $id is picture's ID
     */
    public function loadProgramPicture($id, ProgramPictureRepository $repository)
    {
        // secure $id
        $id = $this->secureInput($id);

        $picture = $repository->find($id);

        return $this->render('load/program_picture.html.twig',[
            'picture' => $picture
        ]);
    }

    /**
     * @Route("/programmes-neufs/programme-video/{id}", name="program_movie")
     * It's for a load page
     * $id is program's ID
     */
    public function loadProgramMovie($id, ProgramRepository $repository)
    {
        // secure $id
        $id = $this->secureInput($id);

        $program = $repository->find($id);

        return $this->render('load/program_movie.html.twig',[
            'program' => $program
        ]);
    }

}