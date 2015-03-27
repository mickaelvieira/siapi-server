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
}
