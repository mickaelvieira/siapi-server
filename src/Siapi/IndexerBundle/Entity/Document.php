<?php

namespace Siapi\IndexerBundle\Entity;

use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Document
 * @package Siapi\IndexerBundle\Entity
 * @ORM\Entity(repositoryClass="Siapi\IndexerBundle\Repository\DocumentRepository")
 * @ORM\Table(name="documents")
 */
class Document implements JsonSerializable
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
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $target;

    /**
     * @var string
     * @ORM\Column(type="string", name="satellite_of", length=255, nullable=true)
     */
    private $satelliteOf;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mission;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $spacecraft;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $instrument;

    /**
     * @var string
     * @ORM\Column(type="string", name="source_url", length=255)
     */
    private $sourceUrl;

    /**
     * @var string
     * @ORM\Column(type="string", name="image_url", length=255)
     */
    private $imageUrl;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="\Siapi\IndexerBundle\Entity\Image", mappedBy="document")
     **/
    private $formats;

    /**
     * @ORM\OneToOne(targetEntity="Siapi\IndexerBundle\Entity\Activity", mappedBy="document")
     **/
    private $activity;

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
     *
     */
    public function __construct()
    {
        $this->formats = new ArrayCollection();
    }

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSourceUrl()
    {
        return $this->sourceUrl;
    }

    /**
     * @param string $sourceUrl
     */
    public function setSourceUrl($sourceUrl)
    {
        $this->sourceUrl = $sourceUrl;
    }

    /**
     * @return string
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * @param string $mission
     */
    public function setMission($mission)
    {
        $this->mission = $mission;
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return array
     */
    public function getFormats()
    {
        return $this->formats;
    }

    /**
     * @param array $formats
     */
    public function setFormats($formats)
    {
        $this->formats = $formats;
    }

    /**
     * @return string
     */
    public function getInstrument()
    {
        return $this->instrument;
    }

    /**
     * @param string $instrument
     */
    public function setInstrument($instrument)
    {
        $this->instrument = $instrument;
    }

    /**
     * @return string
     */
    public function getSatelliteOf()
    {
        return $this->satelliteOf;
    }

    /**
     * @param string $satelliteOf
     */
    public function setSatelliteOf($satelliteOf)
    {
        $this->satelliteOf = $satelliteOf;
    }

    /**
     * @return string
     */
    public function getSpacecraft()
    {
        return $this->spacecraft;
    }

    /**
     * @param string $spacecraft
     */
    public function setSpacecraft($spacecraft)
    {
        $this->spacecraft = $spacecraft;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return mixed
     */
    public function getActivity()
    {
        return $this->activity;
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

    /**
     * @param Image $image
     */
    public function addFormat(Image $image)
    {
        $this->formats->add($image);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = get_object_vars($this);
        $formats = [];

        foreach ($this->formats as $format) {
            array_push($formats, $format->toArray());
        }

        $data['formats'] = $formats;

        return $data;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
