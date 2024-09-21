<?php

namespace App\Repository;

use App\Entity\Livros;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livros>
 *
 * @method Livros|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livros|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livros[]    findAll()
 * @method Livros[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivrosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livros::class);
    }

//    /**
//     * @return Livros[] Returns an array of Livros objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Livros
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
