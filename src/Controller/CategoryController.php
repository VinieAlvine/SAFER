<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\InscriptionType;
use App\Form\SearchType;
use App\Repository\BiensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/category/{id}', name: 'app_category')]
    public function index(BiensRepository $biensRepository,int $id): Response
    {   $form = $this->createForm(SearchType::class);
       // $form->handleRequest($request);
        $Category = $this->entityManager->getRepository(Category::class)->findAll();
      $Biens = $biensRepository->findByCategorie($id);
      //
        return $this->render('category/index.html.twig', [
            'Categories'=> $Category,
            'Biens'=>$Biens,
            'form'=>$form->createView()
        ]);
    }

}
