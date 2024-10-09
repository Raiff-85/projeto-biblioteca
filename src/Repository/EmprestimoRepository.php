<?php

namespace App\Repository;

use App\Entity\Emprestimo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emprestimo>
 *
 * @method Emprestimo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emprestimo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emprestimo[]    findAll()
 * @method Emprestimo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmprestimoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emprestimo::class);
    }

//    /**
//     * @return Emprestimo[] Returns an array of Emprestimo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Emprestimo
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
