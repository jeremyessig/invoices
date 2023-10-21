<?php

namespace App\Repository;

use App\Entity\AccountingPlanned;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountingPlanned>
 *
 * @method AccountingPlanned|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountingPlanned|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountingPlanned[]    findAll()
 * @method AccountingPlanned[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountingPlannedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountingPlanned::class);
    }

//    /**
//     * @return AccountingPlanned[] Returns an array of AccountingPlanned objects
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

//    public function findOneBySomeField($value): ?AccountingPlanned
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
