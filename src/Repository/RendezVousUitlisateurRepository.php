<?php

namespace App\Repository;

use App\Entity\RendezVousUitlisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RendezVousUitlisateur>
 *
 * @method RendezVousUitlisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method RendezVousUitlisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method RendezVousUitlisateur[]    findAll()
 * @method RendezVousUitlisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RendezVousUitlisateurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendezVousUitlisateur::class);
    }

//    /**
//     * @return RendezVousUitlisateur[] Returns an array of RendezVousUitlisateur objects
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

//    public function findOneBySomeField($value): ?RendezVousUitlisateur
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
