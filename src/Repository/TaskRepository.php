<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function create(Task $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function delete(Task $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findTaskById(int $tskId): ?Task
    {
        return $this->findOneBy(['tskId' => $tskId]);
    }

    public function findByUser($user)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.users', 'u')
            ->andWhere('u.usr_id = :user')
            ->setParameter('user', $user->getUsrId())
            ->getQuery()
            ->getResult();
    }

    public function findTasksByTitle(
        string $tskTitle,
        string $search,
    ): ?array {
        return $this->createQueryBuilder('t')
            ->andWhere('t.tskTitle LIKE :val')
            ->setParameter('val', '%' . $tskTitle . '%')
            ->addOrderBy('t.tskTitle', $search)
            ->getQuery()
            ->getResult();
    }
}
