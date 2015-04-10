<?php

namespace Siapi\IndexerBundle\Gallery;

/**
 * Class SizeManager
 * @package Siapi\IndexerBundle\Gallery
 */
final class SizeManager
{
    /**
     * @var array
     */
    private $strategies;

    /**
     *
     */
    public function __construct()
    {
        $this->strategies = [
            new Strategy\Large()
        ];
    }

    /**
     * @param string $name
     * @return \Siapi\IndexerBundle\Gallery\Strategy
     * @throw \LogicException
     */
    public function find($name)
    {
        $strategies = array_filter($this->strategies, function (Strategy $strategy) use ($name) {
            return ($strategy->getName() === $name);
        });

        if (empty($strategies)) {
            throw new \LogicException(sprintf("Cannot find strategy with name %s", $name));
        }

        return current($strategies);
    }
}
