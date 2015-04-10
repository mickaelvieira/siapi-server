<?php

namespace Siapi\IndexerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndexerLog
 *
 * @ORM\Table(name="indexer_logs")
 * @ORM\Entity(repositoryClass="Siapi\IndexerBundle\Repository\IndexerLogRepository")
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
     * @var bool
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isEmpty;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $isParsed;

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

    /**
     * @return boolean
     */
    public function isIsEmpty()
    {
        return $this->isEmpty;
    }

    /**
     * @param boolean $isEmpty
     */
    public function setIsEmpty($isEmpty)
    {
        $this->isEmpty = $isEmpty;
    }

    /**
     * @return boolean
     */
    public function isIsParsed()
    {
        return $this->isParsed;
    }

    /**
     * @param boolean $isParsed
     */
    public function setIsParsed($isParsed)
    {
        $this->isParsed = $isParsed;
    }
}
