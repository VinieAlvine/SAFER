<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Category;
use App\Repository\BiensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\SearchType;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/category/{id}", name="app_category")
     */
    public function index(BiensRepository $biensRepository, int $id,Request $request,Category $category): Response
    {
        $categories = $this->entityManager->getRepository(Category::class)->findAll();
       //dd($categories);
        $biens = $this->entityManager->getRepository(Biens::class)->findByCategory($id);
        //
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $intitule = $data->getIntitule();
            $prix = $data->getPrix();
            $localisation = $data->getLocalisation();
            // Effectuez une requête de recherche dans votre base de données en utilisant les critères spécifiés par l'utilisateur
            $biens = $this->entityManager->getRepository(Biens::class)->findBySearchCriteria($intitule, $prix, $localisation);
           // dd($biens);
            return $this->render('category/index.html.twig', [
                'Categories' => $categories,
                'Biens' => $biens,
                'form'=>$form->createView(),

            ]);

        }
        return $this->render('category/index.html.twig', [
            'Categories' => $categories,
            'category' => $category,
            'Biens' => $biens,
            'form'=>$form->createView(),

        ]);
    }




}


