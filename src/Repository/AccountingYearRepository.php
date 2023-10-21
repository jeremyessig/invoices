<?php

namespace App\Repository;

use App\Entity\AccountingYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountingYear>
 *
 * @method AccountingYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountingYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountingYear[]    findAll()
 * @method AccountingYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountingYearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountingYear::class);
    }

//    /**
//     * @return AccountingYear[] Returns an array of AccountingYear objects
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

//    public function findOneBySomeField($value): ?AccountingYear
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
