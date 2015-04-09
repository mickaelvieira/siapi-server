<?php

namespace Siapi\IndexerBundle\Service;

use Siapi\IndexerBundle\Repository\IndexerLogRepository;

/**
 * Class Generator
 * @package Siapi\IndexerBundle\Service
 */
final class Generator
{
    const START_INDEX = 1;

    const END_INDEX   = 20000;

    /**
     * @param \Siapi\IndexerBundle\Repository\IndexerLogRepository $repository
     */
    public function __construct(IndexerLogRepository $repository)
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
