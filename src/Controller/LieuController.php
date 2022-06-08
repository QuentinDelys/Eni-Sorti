<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/lieu', name: 'lieu_')]
class LieuController extends AbstractController
{
//    #[Route('/lieu', name: 'app_lieu')]
//    public function index(): Response
//    {
//        return $this->render('creationLieu.html.twig', [
//            'controller_name' => 'LieuController',
//        ]);
//    }

    #[Route('/villes', name: 'villes')]
    public function Villes(): Response
    {
        return $this->render('lieu/villes.html.twig', [
            'controller_name' => 'LieuController',
        ]);
    }

    #[Route('/campus', name: 'campus')]
    public function Campus(): Response
    {
        return $this->render('lieu/campus.html.twig', [
            'controller_name' => 'LieuController',
        ]);
    }

//    #[Route('/villes', name: 'villes')]
//    public function Villes(): Response
//    {
//        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//        $user = $this->getUser();/
//        if($user.){}
//            return $this->render('sortie/villes.html.twig', [
//                'controller_name' => 'SortieController',
//            ]);
//    }
}
