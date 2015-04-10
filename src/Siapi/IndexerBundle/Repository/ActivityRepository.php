<?php

namespace Siapi\IndexerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Siapi\IndexerBundle\Entity\Activity;

/**
 * Class ActivityRepository
 * @package Siapi\IndexerBundle\Repository
 */
final class ActivityRepository extends EntityRepository
{

    /**
     * @param string $id
     * @return \Siapi\IndexerBundle\Entity\Activity|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByRemoteId($id)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('a')
            ->from('\Siapi\IndexerBundle\Entity\Activity', 'a')
            ->where('a.id = :identifier')
            ->setParameter('identifier', $id);

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }

    /**
     * @param $offset
     * @param $limit
     * @return \Siapi\IndexerBundle\Entity\Activity[]
     */
    public function getUnParsedIds($offset, $limit)
    {
        $qb = $this->_em->createQueryBuilder();

        $qb->select('a')
            ->from('\Siapi\IndexerBundle\Entity\Activity', 'a')
            ->where('a.isEmpty = :empty')
            ->andWhere('a.isParsed = :parsed')
            ->orderBy('a.id', 'ASC')
            ->setParameter('empty', false)
            ->setParameter('parsed', false)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $query = $qb->getQuery();

        return $query->getResult();
    }

    /**
     * @param \Siapi\IndexerBundle\Entity\Activity $log
     */
    public function addLog(Activity $log)
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
                $log = new Activity();
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
