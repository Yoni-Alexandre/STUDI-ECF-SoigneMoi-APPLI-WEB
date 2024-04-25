<?php

namespace App\Repository;

use App\Entity\RendezVousUtilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RendezVousUtilisateur>
 *
 * @method RendezVousUtilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method RendezVousUtilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method RendezVousUtilisateur[]    findAll()
 * @method RendezVousUtilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendezVousUtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendezVousUtilisateur::class);
    }

//    /**
//     * @return RendezVousUtilisateur[] Returns an array of RendezVousUtilisateur objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RendezVousUtilisateur
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
