<?php

namespace Siapi\IndexerBundle\Service;

use Siapi\IndexerBundle\Entity\Document;
use Siapi\IndexerBundle\Repository\DocumentRepository;
use Siapi\IndexerBundle\Repository\IndexerLogRepository;

/**
 * Class Indexer
 * @package Siapi\IndexerBundle\Service
 */
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
     * @var \Siapi\IndexerBundle\Repository\IndexerLogRepository
     */
    private $logsRepository;

    /**
     * @var \Siapi\IndexerBundle\Repository\DocumentRepository
     */
    private $documentsRepository;

    /**
     * @param                                                      $endPoint
     * @param \Siapi\IndexerBundle\Service\Crawler                 $crawler
     * @param \Siapi\IndexerBundle\Repository\IndexerLogRepository $logsRepository
     * @param \Siapi\IndexerBundle\Repository\DocumentRepository   $documentsRepository
     * @param \Siapi\IndexerBundle\Service\Images                  $images
     */
    public function __construct(
        $endPoint,
        Crawler $crawler,
        IndexerLogRepository $logsRepository,
        DocumentRepository $documentsRepository,
        Images $images
    ) {
        $this->endPoint = (string)$endPoint;
        $this->crawler = $crawler;
        $this->logsRepository = $logsRepository;
        $this->documentsRepository = $documentsRepository;
        $this->images = $images;
    }

    public function process()
    {
        /*var_dump(getcwd());

        $file1 = realpath(getcwd() . "/web/sample/PIA15000.jpg");
        $file2 = realpath(getcwd() . "/web/sample/PIA15001.jpg");

        var_dump(sha1_file($file1));
        var_dump(sha1_file($file2));

        exit;*/

        $logs = $this->logsRepository->getUnParsedIds(0, 10);

        foreach ($logs as $log) {

            $pageUrl = sprintf("%s?id=%s", $this->endPoint, $log->getRemoteId());

            $data = $this->crawler->parse($pageUrl);

            if (!empty($data['title'])) {

                $document = new Document();
                $document->setTitle($data['title']);
                $document->setDescription($data['description']);
                $document->setImageUrl($data['image']);
                $document->setInstrument($data['instrument']);
                $document->setMission($data['mission']);
                $document->setTarget($data['target']);
                $document->setSpacecraft($data['spacecraft']);
                $document->setInstrument($data['instrument']);
                $document->setSourceUrl($pageUrl);

                $this->documentsRepository->addDocument($document);
            } else {
                $log->setIsEmpty(true);
            }
            $log->setIsParsed(true);

            //$this->logsRepository->addLog($log);
            //var_dump($data);
            //var_dump($log);

        }


        //$this->logsRepository->sync();
        $this->documentsRepository->sync();

        //var_dump($logs);

        exit;



    }

    /**
     * @param array $data
     */
    private function onReceiveData(array $data)
    {
        if (isset($data['image'])) {
            $filePath = $this->images->copyRemoteFile($data['image']);
        }

        var_dump($data);
    }
}
