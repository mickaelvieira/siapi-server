<?php

namespace Siapi\IndexerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Activity
 *
 * @ORM\Table(name="activities")
 * @ORM\Entity(repositoryClass="Siapi\IndexerBundle\Repository\ActivityRepository")
 */
class Activity
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
     * @ORM\Column(type="string", name="remote_id", length=255, nullable=false)
     */
    private $remoteId;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_empty", options={"default": false})
     */
    private $isEmpty = false;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_parsed", options={"default": false})
     */
    private $isParsed = false;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_image_downloaded", options={"default": false})
     */
    private $isImageDownloaded = false;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

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

    /**
     * @return boolean
     */
    public function isIsImageDownloaded()
    {
        return $this->isImageDownloaded;
    }

    /**
     * @param boolean $isImageDownloaded
     */
    public function setIsImageDownloaded($isImageDownloaded)
    {
        $this->isImageDownloaded = $isImageDownloaded;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
