<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/mentionLegal', name: 'mentionLegal')]
    public function index(): Response
    {
        return $this->render('main/mention-legal.html.twig');
    }
}
