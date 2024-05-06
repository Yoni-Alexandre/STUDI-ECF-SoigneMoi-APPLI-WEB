<?php

namespace App\Repository;

use App\Entity\PlanningMedecin;
use App\Entity\Medecin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PlanningMedecinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningMedecin::class);
    }

    public function disponibiliteMedecins(Medecin $medecin)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p.date')
            ->andWhere('p.medecin = :medecin')
            ->andWhere('p.nombre_patients_max > (SELECT COUNT(r) FROM App\Entity\RendezVousUtilisateur r WHERE r.date = p.date AND r.medecin = p.medecin)')
            ->setParameter('medecin', $medecin)
            ->orderBy('p.date', 'ASC');

        $dates = $query->getQuery()->getArrayResult();

        $availableSlots = [];
        foreach ($dates as $dateArr) {
            if (isset($dateArr['date']) && $dateArr['date'] instanceof \DateTime) {
                $availableSlots[] = $dateArr['date'];
            }
        }

        return $availableSlots;
    }

    public function disponibiliteMedecin(\DateTimeInterface $date, Medecin $medecin)
    {
        $query = $this->createQueryBuilder('p')
            ->select('p.nombre_patients_max - COUNT(r) as available')
            ->leftJoin('p.rendezVousUtilisateurs', 'r')
            ->andWhere('p.medecin = :medecin')
            ->andWhere('p.date = :date')
            ->setParameter('medecin', $medecin)
            ->setParameter('date', $date)
            ->groupBy('p.id')
            ->getQuery();

        $result = $query->getOneOrNullResult();
        return ($result == null || $result['available'] > 0);
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
