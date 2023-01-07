<?php

namespace App\Repository;

use App\Entity\Biens;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Biens>
 *
 * @method Biens|null find($id, $lockMode = null, $lockVersion = null)
 * @method Biens|null findOneBy(array $criteria, array $orderBy = null)
 * @method Biens[]    findAll()
 * @method Biens[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiensRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Biens::class);
    }

    public function save(Biens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Biens $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Biens[] Returns an array of Biens objects
//     */
    public function findByCategorie(int $id): array
    {
      return $this->createQueryBuilder('b')
          ->select('b')
          ->where('b.category = ' .$id)
          ->getQuery()
          ->getResult();
   }
    public function findBySearchCriteria($intitule, $prix, $localisation)
    {
        return $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.intitule = :intitule')
            ->setParameter('intitule', $intitule)
            ->andWhere('b.prix = :prix')
            ->setParameter('prix', $prix)
            ->andWhere('b.localisation = :localisation')
            ->setParameter('localisation', $localisation)
            ->getQuery()
            ->getResult();
    }
//    public function findOneBySomeField($value): ?Biens
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
