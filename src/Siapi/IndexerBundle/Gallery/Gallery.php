<?php

namespace Siapi\IndexerBundle\Gallery;

use Siapi\IndexerBundle\Service\FileName;

/**
 * Class Gallery
 * @package Siapi\IndexerBundle\Gallery
 */
final class Gallery
{

    /**
     * @var \Siapi\IndexerBundle\Service\FileName
     */
    private $fileName;

    /**
     * @var \Siapi\IndexerBundle\Gallery\SizeManager
     */
    private $sizeManager;

    /**
     * @var array
     */
    private $sizes = [
        'large'
    ];

    /**
     *
     */
    public function __construct()
    {
        $this->fileName = new FileName();
        $this->sizeManager = new SizeManager();
    }

    /**
     * @param string $source
     */
    public function create($source)
    {
        foreach ($this->sizes as $size) {
            $this->createSize($size, $source);
        }
    }

    /**
     * @param string $size
     * @param string $source
     * @return bool
     */
    private function createSize($size, $source)
    {
        $strategy    = $this->sizeManager->find($size);
        $destination = $this->getDestination($source, $size);

        return $strategy->generate($source, $destination);
    }

    /**
     * @param string $source
     * @param string $size
     * @return string
     */
    private function getDestination($source, $size)
    {
        $dirName  = dirname($source);
        $fileName = basename($source);

        return sprintf(
            "%s/%s",
            $dirName,
            $this->fileName->appendSuffix($fileName, $size)
        );
    }
}
