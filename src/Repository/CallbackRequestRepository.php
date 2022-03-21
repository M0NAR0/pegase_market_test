<?php

namespace App\Repository;

use App\Entity\CallbackRequest;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CallbackRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method CallbackRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method CallbackRequest[]    findAll()
 * @method CallbackRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CallbackRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CallbackRequest::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CallbackRequest $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CallbackRequest $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Lists the last five callback requests.
     *
     * @return CallbackRequest[] Returns an array of CallbackRequest objects
     */
    public function findTheLastFive()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * Lists the callback requests to treat today.
     *
     * @return CallbackRequest[] Returns an array of CallbackRequest objects
     */
    public function findTheOnesToTreatToday()
    {
        return $this->createQueryBuilder('c')
            ->where('c.callbackDate = :val')
            ->setParameter('val', ''.date("Y-m-d").'')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return CallbackRequest[] Returns an array of CallbackRequest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CallbackRequest
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
