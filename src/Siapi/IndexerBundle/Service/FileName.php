<?php

namespace Siapi\IndexerBundle\Service;

final class FileName
{

    /**
     * @param string $url
     * @return string|null
     */
    public function getFileNameFromUrl($url)
    {
        $fileName = null;
        $pathName = parse_url((string)$url, PHP_URL_PATH);

        if ($pathName) {
            $result = end(explode("/", $pathName));
            if (preg_match("/(jpg|JPG)$/", $result)) {
                $fileName = $result;
            }
        }
        return $fileName;
    }

    /**
     * @param string $fileName
     * @param string $suffix
     * @return string
     */
    public function appendSuffix($fileName, $suffix)
    {
        $parts     = explode(".", $fileName);
        $extension = array_pop($parts);
        $fileName  = implode(".", $parts);

        return sprintf("%s-%s.%s", $fileName, $suffix, $extension);
    }
}
