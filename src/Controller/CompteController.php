<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    private  $entityManager;
    // private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        // $this->passwordEncoder = $passwordEncoder;
    }

    #[Route('/compte', name: 'app_compte')]
    public function index(): Response
    {
        $Category = $this->entityManager->getRepository(Category::class)->findAll();
        return $this->render('compte/index.html.twig',[ 'Categories'=> $Category]);
    }


}
