<?php

namespace App\Repository;

use App\Entity\Companys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Company>
 *
 * @method Company|null find($id, $lockMode = null, $lockVersion = null)
 * @method Company|null findOneBy(array $criteria, array $orderBy = null)
 * @method Company[]    findAll()
 * @method Company[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompanyRepository extends ServiceEntityRepository {
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Companys::class);
    }

    public function findTopVizualizare():array {
        $em = $this->getEntityManager();
        $builder = $em->createQueryBuilder('c');
        
        $builder->select('c')
            ->from('App\Entity\Companys','c')
            ->orderBy('c.Vizualizare', 'DESC')
            ->setMaxResults(3);
        
        $query = $builder->getQuery();
        $result = $query->getResult();
        
        return $result;
    }
    
    public function pagination(int $pageNumber,int $pageSize):array {
        $em = $this->getEntityManager();
        $builder = $em->createQueryBuilder();

        $builder
            ->select('c')
            ->from('App\Entity\Companys', 'c')
            ->orderBy('c.NumeFirme', 'ASC')
            ->setFirstResult(($pageNumber - 1) * $pageSize) 
            ->setMaxResults($pageSize);

        $query = $builder->getQuery();
        $result = $query->getResult();

        return $result;
    }

    public function countTotalRows() {
        $em = $this->getEntityManager();
        $builder = $em->createQueryBuilder();

        $builder
            ->select('COUNT(c.NumeFirme)') 
            ->from('App\Entity\Companys', 'c'); 

        $query = $builder->getQuery();
        $count = $query->getSingleScalarResult();

        return $count;
    }
}
