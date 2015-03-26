<?php


namespace Siapi\IndexerBundle\Service;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;
use Symfony\Component\DomCrawler\Link;

final class Crawler
{

    /**
     * @var \Goutte\Client
     */
    private $client;


    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $url
     * @return array
     */
    public function getInformation($url)
    {
        $information = [];

        $crawler = $this->client->request('GET', $url);

        $information['title']   = trim($crawler->filter('h1.article_title')->text());
        $information['content'] = trim($crawlerContent = $crawler->filter('.wysiwyg_content')->text());

        $crawlerInfo = $crawler->filter('.image_detail_module');
        $crawlerLink = clone $crawlerInfo;

        $crawlerLink = $crawlerLink->filter('div.download_tiff a');
        $links = $crawlerLink->links();

        $jpgs = array_filter($links, function (Link $link) {
            return (preg_match("/(jpg|JPG)$/", $link->getUri()));
        });

        if (!empty($jpgs)) {

            $jpg = current($jpgs);
            $information['image'] = $jpg->getUri();
        }

        $crawlerInfo = $crawlerInfo->filter('div.mission');
        $details = $crawlerInfo->filter('p')->each(function (DomCrawler $node, $i) {

            $text = $node->text();
            $parts = explode(":", $text);

            $parts = array_map('trim', $parts);

            return $parts;
        });

        foreach ($details as $info) {
            $information[strtolower($info[0])] = $info[1];
        }

        return $information;
    }
}
