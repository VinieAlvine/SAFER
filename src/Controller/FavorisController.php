<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Biens;
use App\Repository\BiensRepository;



class FavorisController extends AbstractController
{

    private  $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/favoris/add/{bien_id}', name: 'app_favoris_add')]
    public function add(SessionInterface $session, $bien_id): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $bien = $this->entityManager->getRepository(Biens::class)->find($bien_id
        );
        {
            // Récupérez l'id de l'utilisateur à partir de la variable de session
            $user_id = $session->get('user_id');


            // Récupérez les favoris de l'utilisateur à partir de la variable de session
            $favoris = $session->get('favoris', []);

            // Ajoutez le bien en favoris pour l'utilisateur
            $favoris[$user_id][] = $bien_id;

            // Enregistrez les favoris de l'utilisateur dans la variable de session
            $session->set('favoris', $favoris);
        }
        return $this->redirectToRoute('app_favoris');
    }
    #[Route('/favoris/delete/{bien_id}', name: 'app_favoris_delete')]
    public function delete(SessionInterface $session, $bien_id): \Symfony\Component\HttpFoundation\RedirectResponse
    {

        // Récupérez l'id de l'utilisateur à partir de la variable de session
        $user_id = $session->get('user_id');

        // Récupérez les favoris de l'utilisateur à partir de la variable de session
        $favoris = $session->get('favoris', []);

        // Supprimez le bien des favoris de l'utilisateur
        if (isset($favoris[$user_id]) && ($key = array_search($bien_id, $favoris[$user_id])) !== false) {
            unset($favoris[$user_id][$key]);
        }

        // Enregistrez les favoris de l'utilisateur dans la variable de session
        $session->set('favoris', $favoris);

        return $this->redirectToRoute('app_favoris');
    }

    #[Route('/favoris', name: 'app_favoris')]
    public function index(SessionInterface $session, BiensRepository $biensRepository): Response
    {
        // Récupérez l'id de l'utilisateur à partir de la variable de session
        $user_id = $session->get('user_id');

        // Récupérez les favoris de l'utilisateur à partir de la variable de session
        $favoris = $session->get('favoris', []);

        // Récupérez les biens en favoris pour l'utilisateur
        $biens = $biensRepository->findBy(['id' => $favoris[$user_id]]);
        $Category = $this->entityManager->getRepository(Category::class)->findAll();

        $favoris = $session->get('favoris', []);
        return $this->render('favoris/index.html.twig', [
            'favoris' => $favoris,
            'Categories'=> $Category,
            'Biens' => $biens,
        ]);
    }
}
