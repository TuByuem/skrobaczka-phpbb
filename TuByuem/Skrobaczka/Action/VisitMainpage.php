<?php

namespace TuByuem\Skrobaczka\Action;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Description of VisitMainpageAction
 *
 * @author TuByuem <tubyuem@wp.pl>
 */
class VisitMainpage extends AbstractAction
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     */
    public function visit($url)
    {
        $this->crawler = $this->client->request('GET', $url);
    }
}
