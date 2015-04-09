<?php

namespace Siapi\IndexerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndexerLog
 *
 * @ORM\Table(name="indexer_logs")
 * @ORM\Entity(repositoryClass="Siapi\IndexerBundle\Repository\IndexerLogRepository")
 * @ORM\ChangeTrackingPolicy("DEFERRED_EXPLICIT")
 */
class IndexerLog
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $remoteId;

    /**
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getRemoteId()
    {
        return $this->remoteId;
    }

    /**
     * @param string $remoteId
     */
    public function setRemoteId($remoteId)
    {
        $this->remoteId = $remoteId;
    }
}
