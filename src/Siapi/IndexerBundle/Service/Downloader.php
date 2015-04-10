<?php


namespace Siapi\IndexerBundle\Service;

/**
 * Class Downloader
 * @package Siapi\IndexerBundle\Service
 */
final class Downloader
{
    /**
     * @var string
     */
    private $localDir;

    /**
     * @var \Siapi\IndexerBundle\Service\FileName
     */
    private $fileNameService;

    /**
     * @param string $localDir
     * @param \Siapi\IndexerBundle\Service\FileName $fileNameService
     * @throws \Exception
     */
    public function __construct($localDir, FileName $fileNameService)
    {
        $this->checkLocalDir($localDir);
        $this->fileNameService = $fileNameService;
    }

    /**
     * @param string $url
     * @return string
     * @throws \Exception
     */
    public function copyRemoteFile($url)
    {
        $fileName = $this->fileNameService->getFileNameFromUrl($url);

        if (!$fileName) {
            throw new \Exception(sprintf("Unable to extract filename from URI %s", $url));
        }

        $filePath = $this->getLocalPath($fileName);

        if (!is_file($filePath)) {
            $this->writeLocalData($fileName, $this->readRemoteData($url));
        }

        return $filePath;
    }

    /**
     * @param string $filePath
     * @param string $data
     */
    private function writeLocalData($filePath, $data)
    {
        file_put_contents($filePath, $data, FILE_APPEND);
    }

    /**
     * @param string $url
     * @return string
     */
    private function readRemoteData($url)
    {
        return file_get_contents($url);
    }

    /**
     * @param string $localDir
     * @throws \Exception
     */
    private function checkLocalDir($localDir)
    {
        $localDir = realpath($localDir) . "/";

        if (!is_dir($localDir)) {
            throw new \Exception(sprintf("%s is not a directory", $localDir));
        }
        if (!is_writable($localDir)) {
            throw new \Exception(sprintf("%s is not a writable", $localDir));
        }

        $this->localDir = $localDir;
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function getLocalPath($fileName)
    {
        return $this->localDir . $fileName;
    }
}
