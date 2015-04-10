<?php

namespace Siapi\IndexerBundle\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Image
 * @package Siapi\IndexerBundle\Entity
 * @ORM\Entity(repositoryClass="Siapi\IndexerBundle\Repository\ImageRepository")
 * @ORM\Table(name="images")
 */
class Image implements JsonSerializable
{

    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer", length=11, unique=true, nullable=false)
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var \Siapi\IndexerBundle\Entity\Document
     *
     * @ORM\ManyToOne(targetEntity="Siapi\IndexerBundle\Entity\Document", inversedBy="formats")
     * @ORM\JoinColumn(name="document_id", referencedColumnName="id")
     **/
    private $document;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $width;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $height;

    /**
     * @var string
     * @ORM\Column(type="string", name="mime_type", length=255)
     */
    private $mimeType;

    /**
     * @var string
     * @ORM\Column(type="integer", length=11)
     */
    private $size;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param string $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * @return string
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param string $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}