<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieFormType;
use App\Repository\SortieRepository;
use ContainerCr6jLy4\getCampusRepositoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sortie', name: 'sortie_')]
class SortieController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function accueil(SortieRepository $sortieRepository, Request $request): Response
    {
        $sortieList = $sortieRepository->findAll();

        $sortieForm = $this->createForm(SortieFormType::class, $sortieList);
        $sortieForm->handleRequest($request);

        return $this->render('sortie/accueil.html.twig', [
            'sortieList' => $sortieList,
            'sortieForm' => $sortieForm->createView(),
        ]);
    }

    #[Route('/add', name: 'addSortie')]
    public function add(): Response
    {
        return $this->render('sortie/creerSortie.html.twig', [
            'controller_name' => 'SortieController',
        ]);
    }

    #[Route('/display{id}', name: 'displaySortie')]
    public function display($id, SortieRepository $sortieRepository): Response
    {
        $sortie = $sortieRepository->find($id);

        return $this->render('sortie/afficher.html.twig', [
            'id' => $id,
            'sortie' => $sortie,
        ]);
    }

//    #[Route('/update', name: 'updateSortie')]
//    public function update(): Response
//    {
//        return $this->render('sortie/modifier.html.twig', [
//            'controller_name' => 'SortieController',
//        ]);
//    }
//
//    #[Route('/cancel', name: 'cancelSortie')]
//    public function cancel(): Response
//    {
//        return $this->render('sortie/annuler.html.twig', [
//            'controller_name' => 'SortieController',
//        ]);
//    }

}
