<?php

namespace App\Repository;

use App\Entity\DateView;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DateView>
 *
 * @method DateView|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateView|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateView[]    findAll()
 * @method DateView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateViewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateView::class);
    }

//    /**
//     * @return DateView[] Returns an array of DateView objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DateView
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
