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
    private $empty = false;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_parsed", options={"default": false})
     */
    private $parsed = false;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="has_parsing_error", options={"default": false})
     */
    private $parsingError = false;

    /**
     * @var bool
     * @ORM\Column(type="boolean", name="is_image_downloaded", options={"default": false})
     */
    private $imageDownloaded = false;

    /**
     * @ORM\OneToOne(targetEntity="Siapi\IndexerBundle\Entity\Document", inversedBy="activity")
     **/
    private $document;

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
    public function isEmpty()
    {
        return $this->empty;
    }

    /**
     * @param boolean $empty
     */
    public function setEmpty($empty)
    {
        $this->empty = $empty;
    }

    /**
     * @return boolean
     */
    public function isParsed()
    {
        return $this->parsed;
    }

    /**
     * @param boolean $parsed
     */
    public function setParsed($parsed)
    {
        $this->parsed = $parsed;
    }

    /**
     * @return boolean
     */
    public function isImageDownloaded()
    {
        return $this->imageDownloaded;
    }

    /**
     * @param boolean $imageDownloaded
     */
    public function setImageDownloaded($imageDownloaded)
    {
        $this->imageDownloaded = $imageDownloaded;
    }

    /**
     * @param boolean $parsingError
     */
    public function setParsingError($parsingError)
    {
        $this->parsingError = $parsingError;
    }

    /**
     * @return bool
     */
    public function hasParsingError()
    {
        return $this->parsingError;
    }

    /**
     * @return mixed
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param mixed $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
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
