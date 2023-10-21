<?php

namespace App\Repository;

use App\Entity\AccountingTag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountingTag>
 *
 * @method AccountingTag|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountingTag|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountingTag[]    findAll()
 * @method AccountingTag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountingTagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountingTag::class);
    }

//    /**
//     * @return AccountingTag[] Returns an array of AccountingTag objects
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

//    public function findOneBySomeField($value): ?AccountingTag
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
