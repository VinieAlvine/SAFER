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
        $Biens = $this->entityManager

               ->getRepository(Biens::class)
               ->createQueryBuilder('b')
               ->orderBy('b.id')
               ->setMaxResults(3)
               ->getQuery()->getResult();

        //dd($Category);
        return $this->render('home/slide.html.twig',[
            'Biens'=>$Biens
        ]);
    }
}
