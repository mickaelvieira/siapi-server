<?php

namespace Siapi\IndexerBundle\Repository;

use Doctrine\ORM\Query\Expr\OrderBy;
use Doctrine\ORM\EntityRepository;
use Siapi\IndexerBundle\Entity\IndexerLog;

/**
 * Class IndexerLogRepository
 * @package Siapi\IndexerBundle\Repository
 */
final class IndexerLogRepository extends EntityRepository
{

    /**
     * @param string $id
     * @return \Siapi\IndexerBundle\Entity\IndexerLog|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByRemoteId($id)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('il')
            ->from('\Siapi\IndexerBundle\Entity\IndexerLog', 'il')
            ->where('il.id = :identifier')
            ->setParameter('identifier', $id);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * @param $offset
     * @param $limit
     * @return \Siapi\IndexerBundle\Entity\IndexerLog[]
     */
    public function getUnParsedIds($offset, $limit)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('il')
            ->from('\Siapi\IndexerBundle\Entity\IndexerLog', 'il')
            ->add('orderBy', new OrderBy('il.id', 'ASC'))
            ->where('il.isEmpty = :empty')
            ->andWhere('il.isParsed = :parsed')
            ->setParameter('empty', false)
            ->setParameter('parsed', false)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function addLog(IndexerLog $log)
    {
        $this->getEntityManager()->persist($log);
    }

    /**
     * @param int $start
     * @param int $end
     * @param string $format
     */
    public function createRange($start, $end, $format)
    {

        for ($i = $start; $i <= $end; $i++) {

            $remoteId = sprintf($format, $i);
            $log = $this->getByRemoteId($remoteId);

            if (is_null($log)) {
                $log = new IndexerLog();
                $log->setRemoteId($remoteId);
                $this->_em->persist($log);
            }
        }

        $this->_em->flush();
    }

    /**
     *
     */
    public function sync()
    {
        $this->getEntityManager()->flush();
    }
}
