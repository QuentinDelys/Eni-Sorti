<?php

namespace App\Repository;

use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sortie>
 *
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function add(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sortie $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Sortie[] Returns an array of Sortie objects
     */
    public function filtre($search, $user, EtatRepository $etatRepository): array
    {
        $qb = $this->createQueryBuilder('t');
            if($search->getCampus()){
                $qb->andWhere('t.campus = :campus')
                    ->setParameter('campus', $search->getCampus()->getId());
            }
            if($search->getNom()){
                $qb->andWhere('t.nom like :nom')
                    ->setParameter('nom', '%' . $search->getNom() . '%');
            }
            if($search->getDateHeureDebut()){
                $qb->andWhere('t.dateHeureDebut > :dateHeureDebut')
                    ->setParameter('dateHeureDebut', $search->getDateHeureDebut());
            }
            if($search->getDateHeureFin()){
                $qb->andWhere('t.dateHeureDebut < :dateHeureFin')
                    ->setParameter('dateHeureFin', $search->getDateHeureFin());
            }
            if($search->isSortiesOrga()){
                $qb->andWhere('t.organisateur = :isOrganisateur')
                    ->setParameter('isOrganisateur', $user);
            }
            if($search->isSortiesInscris()){
                $qb->andWhere(':isSortiesInscris MEMBER OF t.participants')
                    ->setParameter('isSortiesInscris', $user);
            }
            if($search->isSortiesPasInscris()){
                $qb->andWhere(':isSortiesPasInscris MEMBER OF t.participants')
                    ->setParameter('isSortiesPasInscris', $user);
            }
            if($search->isSortiesPassees()){
//            $etat = $etatRepository->findOneBySomeField('etat');
                $qb->andWhere('t.etat = :isSortiesPassees')
                    ->setParameter('isSortiesPassees', $etatRepository->findBy(array('libelle'=> "passée")));
            }

            return $qb->getQuery()->getResult();
    }

}
