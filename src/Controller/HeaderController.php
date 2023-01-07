<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeaderController extends AbstractController
{   private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/header', name: 'app_header')]
    public function index(): Response
    {
        $Category = $this->entityManager->getRepository(Category::class)->findAll();
        dd( $Category);
        return $this->render('base.html.twig', [
            'Categories'=> $Category,
        ]);
    }
}
