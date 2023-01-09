<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class InscriptionController extends AbstractController
{
    private  $entityManager;
   // private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
       // $this->passwordEncoder = $passwordEncoder;
    }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher)
    {       $Category = $this->entityManager->getRepository(Category::class)->findAll();
        // on cree un nouvelle utilisateur
            $user = new User();
            $form = $this->createForm(InscriptionType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // le formulaires est soumis
                $user = $form->getData();
                $plaintextPassword=$user->getPassword() ;

               $hashedPassword = $passwordHasher->hashPassword(
                   $user,
                   $plaintextPassword
               );
               // cryptage du mot de pass
        $user->setPassword($hashedPassword);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }

        return $this->render('inscription/index.html.twig',[
            'form'=>$form->createView(),
            'Categories'=> $Category,
        ]);
    }
}
