<?php

namespace App\Repository;

use App\Entity\AccountingCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountingCategory>
 *
 * @method AccountingCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountingCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountingCategory[]    findAll()
 * @method AccountingCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountingCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountingCategory::class);
    }

//    /**
//     * @return AccountingCategory[] Returns an array of AccountingCategory objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AccountingCategory
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
