<?php

namespace Siapi\IndexerBundle\Gallery\Strategy;

use Siapi\IndexerBundle\Gallery\Strategy;

/**
 * Class Large
 * @package Siapi\IndexerBundle\Gallery\Strategy
 */
final class Large implements Strategy
{

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'large';
    }

    /**
     * {@inheritdoc}
     */
    public function generate($source, $destination)
    {

    }
}
