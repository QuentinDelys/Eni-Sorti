<?php

namespace App\Controller;

use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participant', name: 'participant_')]
class ParticipantController extends AbstractController
{


    #[Route('/detail{id}', name: 'detailProfil')]
    public function detailProfil($id,ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);
        return $this->render('participant/detailProfil.html.twig', [
            'id' => $id,
            'participant'=> $participant,

        ]);
    }

    #[Route('/edit{id}', name: 'edit')]
    public function editProfil($id,ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);
        return $this->render('participant/modifProfil.html.twig', [
            'id' => $id,
            'participant'=> $participant
        ]);
    }


}
