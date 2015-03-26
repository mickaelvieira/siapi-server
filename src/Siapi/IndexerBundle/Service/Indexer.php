<?php

namespace Siapi\IndexerBundle\Service;

final class Indexer
{
    /**
     * @var string
     */
    private $endPoint;

    /**
     * @var \Siapi\IndexerBundle\Service\Crawler
     */
    private $crawler;

    /**
     * @param $endPoint
     * @param \Siapi\IndexerBundle\Service\Crawler $crawler
     */
    public function __construct($endPoint, Crawler $crawler)
    {
        $this->endPoint = (string)$endPoint;
        $this->crawler  = $crawler;
    }

    public function process()
    {
        $pageUrl = sprintf("%s?id=%s", $this->endPoint, 'PIA18295');

        var_dump($this->crawler->getInformation($pageUrl));



    }

}
