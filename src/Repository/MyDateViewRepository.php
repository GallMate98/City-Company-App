<?php

namespace App\Repository;

use App\Entity\MyDateView;
use App\Form\CompanyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MyDateView>
 *
 * @method MyDateView|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyDateView|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyDateView[]    findAll()
 * @method MyDateView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyDateViewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyDateView::class);
    }

    public function findOneByIdJoinedToCategory(int $productId)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p, c
            FROM App\Entity\ p
            INNER JOIN p.category c
            WHERE p.id = :id'
        )->setParameter('id', $productId);

        return $query->getOneOrNullResult();
    }
}
