<?php

namespace App\Repository;

use App\Entity\Lesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Lesson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lesson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lesson[]    findAll()
 * @method Lesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Lesson::class);
    }

    /**
     * @return Lesson[]
     */
    public function findLatestPython():array
    {
        return $this->findFieldLike('subject', 'python')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Lesson[]
     */
    public function findAllPython():array
    {
        return $this->findFieldLike('subject', 'python')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $field
     * @param $value
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function findFieldLike($field, $value): \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('l')
            ->where('l.'.$field.' = :value AND l.state = true')
            ->setParameter('value', $value);
    }


    // /**
    //  * @return Lesson[] Returns an array of Lesson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lesson
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
