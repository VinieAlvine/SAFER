<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/', name: 'app_home')]

    public function index(): Response
    {
        $Biens = $this->entityManager->getRepository(Biens::class)->findAll();
        $Category = $this->entityManager->getRepository(Category::class)->findAll();
        shuffle($Biens);
        //dd($Category);
        //
        return $this->render('home/index.html.twig',[
            'Biens'=>array_slice($Biens, 0, 3),
            'Categories'=> $Category,



        ]);
    }







}
