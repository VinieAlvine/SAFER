<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BiensController extends AbstractController
{
    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/biens', name: 'app_biens')]
    public function index() {
        $Biens = $this->entityManager->getRepository(Biens::class)->findAll();
        $Category = $this->entityManager->getRepository(Category::class)->findAll();

        //dd($Category);
        return $this->render('biens/index.html.twig',[
            'Biens'=>$Biens,
            'Categories'=>$Category
        ]);





    }
}
