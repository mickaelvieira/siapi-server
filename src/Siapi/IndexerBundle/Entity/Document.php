<?php

namespace Siapi\IndexerBundle\Entity;

use JsonSerializable;

class Document implements JsonSerializable
{
    /**
     * @var string
     */
    private $target;

    /**
     * @var string
     */
    private $satelliteOf;

    /**
     * @var string
     */
    private $mission;

    /**
     * @var string
     */
    private $spacecraft;

    /**
     * @var string
     */
    private $instrument;

    /**
     * @var string
     */
    private $extra;

    /**
     * @var string
     */
    private $source;

    /**
     * @var array
     */
    private $formats = [];

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $author
     */
    public function setSource($author)
    {
        $this->source = $author;
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
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param string $extra
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
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
     * @param Image $image
     */
    public function addFormat(Image $image)
    {
        array_push($this->formats, $image);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}