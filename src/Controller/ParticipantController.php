<?php

namespace App\Controller;

use App\Form\ParticipantType;
use App\Repository\ParticipantRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/participant', name: 'participant_')]
class ParticipantController extends AbstractController
{
    private UserPasswordHasherInterface $hasher;

    #[Route('/detail/{id}', name: 'detail')]
    public function detailProfil($id, ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);
        return $this->render('participant/detail.html.twig', [
            'id' => $id,
            'participant' => $participant,

        ]);
    }

    #[Route('/edit', name: 'edit')]
    public function editProfil(ParticipantRepository $participantRepository, Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $participant = $participantRepository->find($this->getUser());
        $participantForm = $this->createForm(ParticipantType::class, $participant);

        $participantForm->handleRequest($request);
        $this->hasher = $hasher;
        if ($participantForm->isSubmitted() && $participantForm->isValid()) {
            $participant->setPassword($this->$hasher->hashPassword($participant, $participantForm->get('password')));

            $participantRepository->add($participant, true);
            $this->addFlash("success", "Votre profil a été mis à jour ");
            return $this->redirectToRoute("sortie_displaySortie", [
                'id' => $participant->getId(),
            ]);
        }

        return $this->render('participant/modif.html.twig', [
            'participantForm' => $participantForm->createView(),
        ]);
    }


}
