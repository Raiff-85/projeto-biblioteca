<?php

namespace App\Repository;

use App\Entity\Bibliotecario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bibliotecario>
 *
 * @method Bibliotecario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bibliotecario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bibliotecario[]    findAll()
 * @method Bibliotecario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BibliotecarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bibliotecario::class);
    }

//    /**
//     * @return Bibliotecario[] Returns an array of Bibliotecario objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bibliotecario
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
