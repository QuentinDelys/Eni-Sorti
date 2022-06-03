<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Participant;
use App\Entity\Sortie;
use App\Form\ListSortiesType;
use App\Form\Model\Search;
use App\Form\SortieFormType;
use App\Repository\CampusRepository;
use App\Repository\EtatRepository;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sortie', name: 'sortie_')]
class SortieController extends AbstractController
{
    #[Route('/accueil', name: 'accueil')]
    public function accueil(SortieRepository $sortieRepository, Request $request): Response
    {
        $search = new Search();
        $sortieList = $sortieRepository->findAll();

        $sortieForm = $this->createForm(ListSortiesType::class, $search);
        $sortieForm->handleRequest($request);

        if($sortieForm->isSubmitted() && $sortieForm->isValid()){

            $this->addFlash("success", "Recherche lancée !");
            return $this->redirectToRoute("sortie_accueil");
        }

        return $this->render('sortie/accueil.html.twig', [
            'sortieList' => $sortieList,
            //'sortieForm' => $sortieForm->createView(),
        ]);
    }

    #[Route('/creerSortie', name: 'creerSortie')]
    public function add(SortieRepository $repo, Request $request, EtatRepository $etatRepo, CampusRepository $campusRepo): Response
    {
        $sortie = new Sortie();

        $sortieForm = $this->createForm(SortieFormType::class, $sortie);
        $sortieForm->handleRequest($request);

        if($sortieForm->isSubmitted() && $sortieForm->isValid()){


            if ($sortieForm->get('enregistrer')->isClicked()) {

                /**
                 * @var Participant $user
                 */
                $user = $this->getUser();;

                $sortie->setOrganisateur($user);
                $sortie->setEtat($etatRepo->findOneBy(array('libelle' => 'Créée')));
                $sortie->setCampus($user->getCampus());

                $repo->add($sortie, true);
                $this->addFlash("success", "sortie ajoutée avec succès !");
                return $this->redirectToRoute("sortie_accueil");
            }

            if ($sortieForm->get('publier')->isClicked()) {

                /**
                 * @var Participant $user
                 */
                $user = $this->getUser();;

                $sortie->setOrganisateur($user);
                $sortie->setEtat($etatRepo->findOneBy(array('libelle' => 'Ouverte')));
                $sortie->setCampus($user->getCampus());

                $repo->add($sortie, true);
                $this->addFlash("success", "sortie ajoutée avec succès !");
                return $this->redirectToRoute("sortie_accueil");
            }
        }

        return $this->render('sortie/creerSortie.html.twig', [
            'sortieForm' => $sortieForm->createView()
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

    #[Route('/modifierSortie/{id}', name: 'modifierSortie')]
    public function update(int $id, SortieRepository $repoSortie, EtatRepository $etatRepo, Request $request): Response
    {
        $sortie = $repoSortie->find($id);
        $SortieForm = $this->createForm(SortieFormType::class, $sortie);
        $SortieForm->handleRequest($request);

        //traitement des boutons2 pas sur!!!!!!!!!!!!!!!
        if ($SortieForm->isSubmitted() && $SortieForm->isValid()) {

            if ($SortieForm->get('publier')->isClicked()) {

                /**
                 * @var Participant $user
                 */
                $user = $this->getUser();;

                $sortie->setOrganisateur($user);
                $sortie->setEtat($etatRepo->findOneBy(array('libelle' => 'Ouverte')));
                $sortie->setCampus($user->getCampus());

                $repoSortie->add($sortie, true);
                $this->addFlash("success", "sortie ajoutée avec succès !");
                return $this->redirectToRoute("sortie_accueil");
            }
            if ($SortieForm->get('enregistrer')->isClicked()) {

                /**
                 * @var Participant $user
                 */
                $user = $this->getUser();;

                $sortie->setOrganisateur($user);
                $sortie->setEtat($etatRepo->findOneBy(array('libelle' => 'Créée')));
                $sortie->setCampus($user->getCampus());

                $repoSortie->add($sortie, true);
                $this->addFlash("success", "sortie ajoutée avec succès !");
                return $this->redirectToRoute("sortie_accueil");
            }
        }
            if ($SortieForm->get('supprimer')->isClicked()) {
                return $this->redirectToRoute("sortie_supprimerSortie");

            }
            return $this->render('sortie/modifier.html.twig', [
                'controller_name' => 'SortieController',
            ]);
        }

        #[Route('/supprimerSortie/{id}', name: 'supprimerSortie')]
    public function remove($id, SortieRepository $repo): Response
    {
        $sortie = $repo->find($id);
        $repo->remove($sortie, true);

        return $this->redirectToRoute("sortie_accueil");
    }


}
