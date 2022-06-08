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
            if ($participantForm->get('nom')->getData() == $participant->getUserIdentifier()) {
                $this->addFlash("success", "Le pseudo est déja utilisé ");
            } else {
                if ($participantForm->get('password')->getData() === null) {
                    $participantRepository->add($participant, true);
                    $this->addFlash("success", "Votre profil a été mis à jour ");
                    return $this->redirectToRoute("sortie_displaySortie", [
                        'id' => $participant->getId(),
                    ]);
                } else {
                    $newPassword = $participantForm->get('password')->getData();
                    $participant->setPassword($this->hasher->hashPassword($participant, $newPassword));
                    $participantRepository->add($participant, true);
                    $this->addFlash("success", "Votre profil a été mis à jour ");
                    return $this->redirectToRoute("sortie_accueil", [
                        'id' => $participant->getId(),
                    ]);
                }
            }
        }


        return $this->render('participant/modif.html.twig', [
            'participantForm' => $participantForm->createView(),
        ]);
    }


}
