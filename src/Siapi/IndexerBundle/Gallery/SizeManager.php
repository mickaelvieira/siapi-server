<?php


namespace Siapi\IndexerBundle\Gallery;


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
     * @param $name
     * @return \Siapi\IndexerBundle\Gallery\Strategy
     * @throw \LogicException
     */
    public function find($name)
    {
        $strategies = array_filter($this->strategies, function (Strategy $strategy) use ($name) {
            return ($strategy->getName() === $name);
        });

        if (empty($strategies)) {
            throw new \LogicException(sprintf("Strategy %s does not exist", $name));
        }

        return current($strategies);
    }
}
