<?php

namespace App\Controller;

use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function accueil(SortieRepository $sortieRepository): Response
    {
        $sortie = $sortieRepository->findAll();
        return $this->render('sortie/accueil.html.twig', [
            'sortie' => $sortie,
        ]);
    }

    #[Route('/add', name: 'addSortie')]
    public function add(): Response
    {
        return $this->render('sortie/accueil.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }

    #[Route('/display{id}', name: 'displaySortie')]
    public function display($id, SortieRepository $sortieRepository): Response
    {
        $sortie = $sortieRepository->find($id);

        return $this->render('sortie/accueil.html.twig', [
            'id' => $id,
            'sortie' => $sortie,
        ]);
    }

//    #[Route('/update', name: 'updateSortie')]
//    public function update(): Response
//    {
//        return $this->render('sortie/accueil.html.twig', [
//            'controller_name' => 'SortieController',
//        ]);
//    }
//
//    #[Route('/cancel', name: 'cancelSortie')]
//    public function cancel(): Response
//    {
//        return $this->render('sortie/accueil.html.twig', [
//            'controller_name' => 'SortieController',
//        ]);
//    }

}
