<?php

namespace App\Controller;

use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participant', name: 'participant_')]
class ParticipantController extends AbstractController
{


    #[Route('/detail/{id}', name: 'detail')]
    public function detailProfil($id,ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);
        return $this->render('participant/detail.html.twig', [
            'id' => $id,
            'participant'=> $participant,

        ]);
    }

    #[Route('/edit', name: 'edit')]
    public function editProfil(ParticipantRepository $participantRepository, Request $request): Response
    {
        $participant = $participantRepository->find($this->getUser());
        $participantForm = $this->createForm(ParticipantType::class, $participant);

        $participantForm -> handleRequest($request);

        if ($participantForm -> isSubmitted() && $participantForm-> isValid()) {
            if ($participantForm->getp)
            $participantRepository->add($participant, true);
            $this->addFlash("success", "Votre profil a été mis à jour ");
            return $this->redirectToRoute("displaySortie",[
                'id' => $participant->getId(),
            ]);
        }

        return $this->render('participant/modif.html.twig', [
            'participantForm' => $participantForm->createView(),
        ]);
    }


}
