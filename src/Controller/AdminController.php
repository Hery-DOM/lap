<?php


namespace App\Controller;

use App\Entity\Program;
use App\Entity\ProgramPicture;
use App\Entity\ProgramProperty;
use App\Form\ProgramPictureType;
use App\Form\ProgramPropertyType;
use App\Repository\ProgramPictureRepository;
use App\Repository\ProgramPropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends EasyAdminController
{


    /**
     * @Route("/adminu6vbu7388", name="easyadmin")
     */
    /*public function createNewUserEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function persistUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }

    public function updateUserEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }*/

    public function managePicturesAction()
    {
        $request = $this->request;
        $idProgram = $request->query->get('id');
        $prog = $this->getDoctrine()->getRepository(Program::class)->find($idProgram);
        $pictures = $prog->getProgramPicture();

        // get form
        $picture = new ProgramPicture();
        $form = $this->createForm(ProgramPictureType::class, $picture);
        $form->handleRequest($request);

        // if form is submitted
        if($form->isSubmitted() && $form->isValid()){
            //pour ajouter une image
            /** @var UploadedFile $imageFile */
            $imageFile = $form['picture']->getData();

            // Condition nécessaire car le champ 'image' n'est pas requis
            // donc le fichier doit être traité que s'il est téléchargé
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // Nécessaire pour inclure le nom du fichier en tant qu'URL + sécurité + nom unique
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                if ($imageFile->guessExtension() == 'jpg' || $imageFile->guessExtension() == 'png' ||
                    $imageFile->guessExtension() == 'jpeg') {
                    // Déplace le fichier dans le dossier des images d'articles
                    try {

                        $move = $imageFile->move(
                            $this->getParameter('upload_path'),
                            $newFilename
                        );
                        if (!$move) {
                            throw new FileException('Erreur lors du chargement de l\'image');
                        }
                    } catch (FileException $e) {
                        // ... capture de l'exception
                        $this->addFlash('info', "Erreur reçue : " . $e->getMessage());
                        return $this->redirectToRoute('admin_article_create');
                    }

                    // Met à jour l'image pour stocker le nouveau nom de l'image
                    $picture->setPicture($newFilename);
                } else {
                    $this->addFlash('info', 'Erreur sur le format de l\'image');
                    return $this->redirectToRoute('admin_article_create');
                }
            }

            $picture->setListorder(0);
            $picture->setProgram($prog);

            $this->em->persist($picture);
            $this->em->flush();
        }

        return $this->render('admin/program_pictures.html.twig',[
            'pictures' => $pictures,
            'program' => $prog,
            'form' => $form->createView()
        ]);
    }

    public function secureInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }

    public function getFormHTML($form)
    {
        $result = [];

        // check if it's an array
        if(is_array($form)){

            foreach($form as $key => $value){
                // secure input
                $key = $this->secureInput($key);
                if(!is_array($value)){
                    $value = $this->secureInput($value);
                }
                $result[$key] = $value;

            }

        }else{
            return false;
        }

        return $result;


    }


    /**
     * @Route("/easyadmin-ajax", name="easyadmin_ajax")
     * No view - AJAX
     */
    public function easyadminAjax(ProgramPictureRepository $repository, EntityManagerInterface $entityManager)
    {
        // secure input
        $post = $this->getFormHTML($_POST);
        foreach($post as $key => $value){
            $picture = $repository->find($key);
            if($picture) {
                $picture->setListorder($value);
                $entityManager->persist($picture);
                $entityManager->flush();
            }

        }

        return new Response(json_encode('ok'));
    }

    /**
     * @Route("/easyadmin-picture-delete/{id}", name="easyadmin_picture_delete")
     * No view - AJAX
     */
    public function easyadminPictureDelete($id, ProgramPictureRepository $repository, EntityManagerInterface $entityManager)
    {
        // seucre $id
        $id = $this->secureInput($id);

        $picture = $repository->find($id);

        $program = $picture->getProgram()->getId();

        if(!is_null($picture->getPicture())){
            try{
                $remove = unlink('assets/img/programs/'.$picture->getPicture());
                if(!$remove){
                    throw new FileException();
                }
            }catch(FileException $e){
                return false;
            }
        }

        $entityManager->remove($picture);
        $entityManager->flush();

        return $this->redirectToRoute('easyadmin',[
            'action' => 'managePictures',
            'entity' => 'Program',
            'id' => $program
        ]);

    }


    public function managePropertyAction()
    {
        $request = $this->request;
        $idProgram = $request->query->get('id');
        $program = $this->getDoctrine()->getRepository(Program::class)->find($idProgram);
        $property = new ProgramProperty();
        $properties = $program->getProgramProperties();

        $form = $this->createForm(ProgramPropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $property->setListorder(0);
            $property->setProgram($program);
            $this->em->persist($property);
            $this->em->flush();
        }

        return $this->render('admin/program_properties.html.twig',[
            'form' => $form->createView(),
            'properties' => $properties,
            'program' => $program
        ]);

    }

    /**
     * @Route("/easyadmin-property-ajax", name="easyadmin_property_ajax")
     * No view - AJAX
     */
    public function easyadminPropertyAjax(ProgramPropertyRepository $repository, EntityManagerInterface $entityManager)
    {
        // secure input
        $post = $this->getFormHTML($_POST);
        foreach($post as $key => $value){
            $property = $repository->find($key);
            if($property) {
                $property->setListorder($value);
                $entityManager->persist($property);
                $entityManager->flush();
            }

        }

        return new Response(json_encode('ok'));
    }

    /**
     * @Route("/easyadmin-property-delete/{id}", name="easyadmin_property_delete")
     * No view
     */
    public function easyadminPropertyDelete($id, ProgramPropertyRepository $programPropertyRepository,
                                            EntityManagerInterface $entityManager)
    {
        // secure $id
        $id = $this->secureInput($id);

        $property = $programPropertyRepository->find($id);
        $program = $property->getProgram()->getId();
        $entityManager->remove($property);
        $entityManager->flush();

        return $this->redirectToRoute('easyadmin',[
            'action' => 'manageProperty',
            'entity' => 'Program',
            'id' => $program
        ]);

    }


}