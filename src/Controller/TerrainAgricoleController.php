<?php

namespace App\Controller;

use App\Entity\Biens;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TerrainAgricoleController extends AbstractController
{
    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/terrain/agricole', name: 'app_terrain_agricole')]
    public function index()
    {
        $Category = $this->entityManager->getRepository(Category::class)->findOneBy(['nom' => 'Terrain agricole']);
        $Biens = $Category->getBiens();
      //dd($Biens);
        //dd($Category);
        return $this->render('terrain_agricole/index.html.twig',[
           'Biens'=>$Biens,
            'Category'=>$Category
       ]);
        //return $this->render('terrain_agricole/index.html.twig',[
         //   'Category'=>$Category
       // ]);




    }
}
