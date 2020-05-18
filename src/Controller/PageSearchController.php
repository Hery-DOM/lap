<?php


namespace App\Controller;


use App\Repository\CriteriaRepository;
use App\Repository\ProgramRepository;
use App\Repository\SearchPageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageSearchController extends PersonalClass
{
    /**
     * @Route("/trouvez-un-logement/", name="search_redirect")
     * @Route("/trouvez-un-logement", name="search_redirect2")
     * No view, to redirect if there isn't a slug
     */
    public function searchRedirect()
    {
        return $this->redirectToRoute('search',[
            'slug' => 'bordeaux-metropole'
        ]);
    }

    /**
     * @Route("/trouvez-un-logement/{slug}", name="search")
     */
    public function search($slug, ProgramRepository $programRepository, Request $request, CriteriaRepository
    $criteriaRepository, SearchPageRepository $searchPageRepository)
    {
        // secure $slug
        $slug = $this->secureInput($slug);

        // get text
        $text = $searchPageRepository->findAll();

        // get every cities
        $homes = $programRepository->findBy([],['city' => 'ASC']);
        $cities = [];
        foreach($homes as $home){
            if(!in_array($home->getCity(),$cities)){
                $cities[] = $home->getCity();
            }
        }

        // get every typologies
        $typoInit = [];
        foreach($homes as $home){
            if(!in_array($home->getTypologie(),$typoInit)){
                $typoInit[] = $home->getTypologie();
            }
        }

        // get every criteria with the name "prestations"
        $prestationsInit = $criteriaRepository->findBy(['name' => 'prestations']);


        // initialize $programs and $form ($form is to save choices from the form in search's page)
        $programs = '';
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


        // get url
        $url = $this->getUrl('projets-pro/lap');

        // a form submited
        if($request->isMethod('POST')){

            // if it's the contact form in modal
            if(isset($_POST['search-modal'])){
                dd('test');
            }else{
                // if it's the search barre
                // init the variables
                $city = '';
                $typo = '';
                $priceMin = '';
                $priceMax = '';
                $surfaceMin = '';
                $surfaceMax = '';
                $handicap = '';
                $disponibilty = [];
                $rooms = [];
                $prestations = [];
                $othersCriteria = [];

                // secure the inputs if exist + save in variable
                if(isset($_POST['city'])){
                    $city = $this->secureInput($_POST['city']);
                    $form['city'] = $city;
                }
                if(isset($_POST['typologie'])){
                    $typo = $this->secureInput($_POST['typologie']);
                    $form['typo'] = $typo;
                }
                if(isset($_POST['priceMin'])){
                    $priceMin = $this->secureInput($_POST['priceMin']);
                    $form['priceMin'] = $priceMin;
                }
                if(isset($_POST['priceMax'])){
                    $priceMax = $this->secureInput($_POST['priceMax']);
                    $form['priceMax'] = $priceMax;
                }
                if(isset($_POST['surfaceMin'])){
                    $surfaceMin = $this->secureInput($_POST['surfaceMin']);
                    $form['surfaceMin'] = $surfaceMin;
                }
                if(isset($_POST['surfaceMax'])){
                    $surfaceMax = $this->secureInput($_POST['surfaceMax']);
                    $form['surfaceMax'] = $surfaceMax;
                }
                if(isset($_POST['handicap']) && $this->secureInput($_POST['handicap']) === 'on'){
                    $handicap = true;
                    $form['handicap'] = $handicap;
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

                // find the programs
                // first : get the programs with the firsts criteria by repository
                $programs = $programRepository->findBySearch($city,$typo,$priceMin,$priceMax,$surfaceMin,$surfaceMax,
                    $handicap);

                // second : get the programs with the the criteria rooms, disponibility, prestation and others
                // ROOMS
                if(!empty($rooms)){
                    $temp = [];
                    foreach($programs as $program){
                        foreach($rooms as $room){
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
                    $programs = [];
                    $programs = $temp;
                    $temp = [];
                }


                // DISPONIBILTY
                if(!empty($disponibilty)){
                    $temp = [];
                    foreach($programs as $program){
                        foreach($disponibilty as $dispo){
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
                    $programs = [];
                    $programs = $temp;
                    $temp = [];
                }

                // PRESTATIONS
                if(!empty($prestations)){
                    $temp = [];
                    foreach($programs as $program){

                        foreach($prestations as $prestation){
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
                    $programs = [];
                    $programs = $temp;
                    $temp = [];

                }

                // for the slug
                if(empty($city)){
                    $city = 'bordeaux-metropole';
                }

                // total number pages
                $pages = ceil(count($programs)/8);

                // get 8 programs for one page
                // get the number of page according with submit button's name
                $nb = 1;
                foreach($_POST as $key => $post){
                    $key = $this->secureInput($key);
                    if(preg_match('#search-submit-#', $key)){

                        $nb = substr($key,14);
                        $programs = $this->pageSearch($programs,$nb);
                    }
                }



                return $this->render('web/search.html.twig',[
                    'cities' => $cities,
                    'typologies' => $typoInit,
                    'programs' => $programs,
                    'url' => $url,
                    'pages' => $pages,
                    'form' => $form,
                    'prestations' => $prestationsInit,
                    'currentPage' => $nb,
                    'text' => $text,
                    'slug' => $slug
                ]);
            }


        }

        return $this->render('web/search.html.twig',[
            'cities' => $cities,
            'typologies' => $typoInit,
            'programs' => $programs,
            'url' => $url,
            'form' => $form,
            'prestations' => $prestationsInit,
            'text' => $text,
            'slug' => $slug
        ]);

    }






}