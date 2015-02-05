<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use Symfony\Component\BrowserKit\Client;

/**
 * Description of VisitMainpageAction
 *
 * @author TuByuem <tubyuem@wp.pl>
 */
class Mainpage extends AbstractUrlVisitor
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
