<?php

namespace Siapi\IndexerBundle\Entity;

use SplFileInfo;
use JsonSerializable;

class Image extends SplFileInfo implements JsonSerializable
{
    /**
     * @var string
     */
    private $width;

    /**
     * @var string
     */
    private $height;

    /**
     * @var integer
     */
    private $imageType;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @param $file_name
     */
    public function __construct($file_name)
    {
        parent::__construct($file_name);
        $this->extractImageInfo();
    }

    private function extractImageInfo()
    {
        $info = getimagesize($this->getRealPath());
        if ($info) {
            $this->setWidth($info[0]);
            $this->setHeight($info[1]);
            $this->setImageType($info[2]);
            $this->setMimeType($info['mime']);
        }
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
     * @return int
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * @param int $imageType
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;
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
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'width'    => $this->width,
            'height'   => $this->height,
            'mimeType' => $this->mimeType,
            'filename' => $this->getBasename(),
            'size'     => $this->getSize(),
        ];
    }
}