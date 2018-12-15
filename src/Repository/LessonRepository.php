<?php

namespace App\Repository;

use App\Entity\Lesson;
use App\Entity\LessonSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\Query;
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
     * @return Query
     */
    public function findAllPythonQuery(LessonSearch $search): Query
    {
        $query = $this->findVisibleQuery();

        if($search->getGrade())
        {
            $query = $query->andWhere('l.grade = :grade')
                ->setParameter('grade', $search->getGrade());
        }
        if($search->getType())
        {
            $query = $query->andWhere('l.type = :type')
                ->setParameter('type', $search->getType());
        }
        if($search->getSubject())
        {
            $query = $query->andWhere('l.subject = :subject')
                ->setParameter('subject', $search->getSubject());
        }

        if($search->getTags()->count() > 0)
        {
            $k = 0;
            foreach ($search->getTags() as $k => $tag)
            {
                $k++;
                $query = $query
                    ->andWhere(":tag$k MEMBER OF l.tags")
                    ->setParameter("tag$k", $tag);
            }
        }

        return $query->getQuery();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function findVisibleQuery(): \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('l')
            ->where('l.state = true');
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
