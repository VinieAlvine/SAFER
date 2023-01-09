<?php

namespace App\Controller;

use App\Entity\Biens;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SlideController extends AbstractController
{
    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/slide', name: 'app_slide')]
    public function index(): Response
    {
        // on récupère tous les biens
        $Biens = $this->entityManager->getRepository(Biens::class)->findAll();
        // on mélange les biens
        shuffle($Biens);

        //dd($Category);
        // on sélectionne 3 et on affiche
        return $this->render('home/index.html.twig',[
            'Biens'=>array_slice($Biens, 0, 3)
        ]);
    }
}
