<?php

namespace Siapi\IndexerBundle\Service;

use Siapi\IndexerBundle\Entity\Document;
use Siapi\IndexerBundle\Repository\DocumentRepository;
use Siapi\IndexerBundle\Repository\ActivityRepository;

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
     * @var \Siapi\IndexerBundle\Service\Downloader
     */
    private $downloader;

    /**
     * @var \Siapi\IndexerBundle\Repository\ActivityRepository
     */
    private $activitiesRepository;

    /**
     * @var \Siapi\IndexerBundle\Repository\DocumentRepository
     */
    private $documentsRepository;

    /**
     * @param                                                      $endPoint
     * @param \Siapi\IndexerBundle\Service\Crawler                 $crawler
     * @param \Siapi\IndexerBundle\Repository\ActivityRepository $activitiesRepository
     * @param \Siapi\IndexerBundle\Repository\DocumentRepository   $documentsRepository
     * @param \Siapi\IndexerBundle\Service\Downloader                  $downloader
     */
    public function __construct(
        $endPoint,
        Crawler $crawler,
        ActivityRepository $activitiesRepository,
        DocumentRepository $documentsRepository,
        Downloader $downloader
    ) {
        $this->endPoint = (string)$endPoint;
        $this->crawler = $crawler;
        $this->activitiesRepository = $activitiesRepository;
        $this->documentsRepository = $documentsRepository;
        $this->downloader = $downloader;
    }

    public function process()
    {
        $logs = $this->activitiesRepository->getUnParsedIds(0, 100);

        while (count($logs) > 0) {

            var_dump("---------------------------NEW BATCH---------------------------");

            foreach ($logs as $log) {

                $pageUrl = sprintf("%s?id=%s", $this->endPoint, $log->getRemoteId());

                var_dump($pageUrl);

                $data = null;

                $log->setParsingError(false);

                try {
                    $data = $this->crawler->parse($pageUrl);
                } catch (\Exception $e) {

                    var_dump($e->getMessage());

                    $log->setParsingError(true);
                }

                if ($data) {

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

                        $log->setDocument($document);

                    } else {
                        $log->setEmpty(true);
                    }
                    $log->setParsed(true);
                }


                //$this->logsRepository->addLog($log);
                //var_dump($data);
                var_dump("Is Empty: " . $log->isEmpty());
                var_dump("is Parsed: " . $log->isParsed());
                var_dump("Has Error: " . $log->hasParsingError());

            }
            $this->documentsRepository->sync();

            var_dump("---------------------------FLUSH---------------------------");

            $logs = $this->activitiesRepository->getUnParsedIds(0, 100);
        }



        //$this->logsRepository->sync();


        //var_dump($logs);

        exit;



    }
}
