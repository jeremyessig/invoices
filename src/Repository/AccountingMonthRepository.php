<?php

namespace App\Repository;

use App\Entity\AccountingMonth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountingMonth>
 *
 * @method AccountingMonth|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountingMonth|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountingMonth[]    findAll()
 * @method AccountingMonth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountingMonthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountingMonth::class);
    }

//    /**
//     * @return AccountingMonth[] Returns an array of AccountingMonth objects
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

//    public function findOneBySomeField($value): ?AccountingMonth
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
