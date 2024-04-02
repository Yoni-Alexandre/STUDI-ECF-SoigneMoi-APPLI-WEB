<?php

namespace App\Repository;

use App\Entity\PlanningMedecin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanningMedecin>
 *
 * @method PlanningMedecin|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningMedecin|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningMedecin[]    findAll()
 * @method PlanningMedecin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningMedecinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningMedecin::class);
    }

//    /**
//     * @return PlanningMedecin[] Returns an array of PlanningMedecin objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlanningMedecin
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
