<?php

namespace App\Repository;

use App\Entity\AccountingEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountingEntry>
 *
 * @method AccountingEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountingEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountingEntry[]    findAll()
 * @method AccountingEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountingEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountingEntry::class);
    }

//    /**
//     * @return AccountingEntry[] Returns an array of AccountingEntry objects
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

//    public function findOneBySomeField($value): ?AccountingEntry
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
