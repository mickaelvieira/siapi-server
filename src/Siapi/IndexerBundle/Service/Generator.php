<?php

namespace Siapi\IndexerBundle\Service;

use Siapi\IndexerBundle\Repository\ActivityRepository;

/**
 * Class Generator
 * @package Siapi\IndexerBundle\Service
 */
final class Generator
{
    const START_INDEX = 1;

    const END_INDEX   = 20000;

    /**
     * @param \Siapi\IndexerBundle\Repository\ActivityRepository $repository
     */
    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *
     */
    public function process()
    {
        $this->repository->createRange(self::START_INDEX, self::END_INDEX, "PIA%05d");
    }
}
