<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    #[Route('/', name: 'app_sortie')]
    public function home(): Response
    {
        return $this->render('sortie/accueil.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }
}
