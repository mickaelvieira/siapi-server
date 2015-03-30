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
     * @param string $url
     * @param callable $callback
     * @return array
     */
    public function parse($url, callable $callback)
    {
        $information = [];

        $crawler = $this->client->request('GET', $url);

        $information['title']   = trim($crawler->filter('h1.article_title')->text());
        $information['content'] = trim($crawlerContent = $crawler->filter('.wysiwyg_content')->text());

        $crawler = $crawler->filter('.image_detail_module');

        $details = $this->getInformation(clone $crawler);
        $images  = $this->getJpegUrl(clone $crawler);

        $information = array_merge($information, $images, $details);

        $callback($information);
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     * @return array
     */
    private function getJpegUrl($crawler)
    {
        $images = [];

        $crawler = $crawler->filter('div.download_tiff a');
        $links   = $crawler->links();

        $jpeg = array_filter($links, function (Link $link) {
            return (preg_match("/(jpg|JPG)$/", $link->getUri()));
        });

        if (!empty($jpeg)) {
            $jpg = current($jpeg);
            $images['image'] = $jpg->getUri();
        }

        return $images;
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     * @return array
     */
    private function getInformation($crawler)
    {
        $information = [];

        $crawler = $crawler->filter('div.mission');
        $details = $crawler->filter('p')->each(function (DomCrawler $node, $i) {

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
