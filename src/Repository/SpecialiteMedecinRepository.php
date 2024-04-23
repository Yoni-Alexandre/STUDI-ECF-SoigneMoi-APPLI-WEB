<?php

namespace App\Repository;

use App\Entity\SpecialiteMedecin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SpecialiteMedecin>
 *
 * @method SpecialiteMedecin|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpecialiteMedecin|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpecialiteMedecin[]    findAll()
 * @method SpecialiteMedecin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialiteMedecinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpecialiteMedecin::class);
    }

//    /**
//     * @return SpecialiteMedecin[] Returns an array of SpecialiteMedecin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SpecialiteMedecin
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
