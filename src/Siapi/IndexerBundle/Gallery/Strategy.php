<?php


namespace Siapi\IndexerBundle\Gallery;


interface Strategy
{

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $source
     * @param string $destination
     * @return bool
     */
    public function generate($source, $destination);
}
