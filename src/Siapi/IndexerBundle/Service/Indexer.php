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
     * @var \Siapi\IndexerBundle\Service\Images
     */
    private $images;

    /**
     * @param $endPoint
     * @param \Siapi\IndexerBundle\Service\Crawler $crawler
     * @param \Siapi\IndexerBundle\Service\Images $images
     */
    public function __construct($endPoint, Crawler $crawler, Images $images)
    {
        $this->endPoint = (string)$endPoint;
        $this->crawler  = $crawler;
        $this->images   = $images;
    }

    public function process()
    {
        $pageUrl = sprintf("%s?id=%s", $this->endPoint, 'PIA18295');

        $this->crawler->parse($pageUrl, function ($data) {
            $this->onReceiveData($data);
        });
    }

    /**
     * @param array $data
     */
    private function onReceiveData(array $data)
    {
        if (isset($data['image'])) {
            $filePath = $this->images->copyRemoteFile($data['image']);
        }

        //var_dump($data);
    }

}
