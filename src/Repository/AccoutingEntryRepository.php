<?php

namespace App\Repository;

use App\Entity\AccoutingEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccoutingEntry>
 *
 * @method AccoutingEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccoutingEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccoutingEntry[]    findAll()
 * @method AccoutingEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccoutingEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccoutingEntry::class);
    }

//    /**
//     * @return AccoutingEntry[] Returns an array of AccoutingEntry objects
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

//    public function findOneBySomeField($value): ?AccoutingEntry
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
