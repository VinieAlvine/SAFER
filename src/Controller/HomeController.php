<?php

namespace App\Controller;

use App\Entity\Biens;
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
        $Biens = $this->entityManager
            ->getRepository(Biens::class)
            ->createQueryBuilder('b')
            ->orderBy('b.id')
            ->setMaxResults(3)
            ->getQuery()->getResult();

        //dd($Category);
        return $this->render('home/index.html.twig',[
            'Biens'=>$Biens
        ]);
    }







}
