<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BatimentsController  extends AbstractController
{
    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/batiments', name: 'app_batiments')]
    public function index() {
        $Category = $this->entityManager->getRepository(Category::class)->findOneBy(['nom' => 'Bâtiments']);
        $Biens = $Category->getBiens();
        //dd($Biens);
        //dd($Category);
        return $this->render('batiments/index.html.twig',[
            'Biens'=>$Biens
        ]);
    }
}
