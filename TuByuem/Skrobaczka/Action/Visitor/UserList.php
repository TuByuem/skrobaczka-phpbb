<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;
use TuByuem\Skrobaczka\Action\Login as LoginAction;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class UserList extends AbstractPagedVisitor
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var LoginAction
     */
    private $loginAction;

    /**
     * @var array
     */
    private $options;

    /**
     * @var Crawler
     */
    private $firstPageCrawler;

    /**
     * @param Client      $client
     * @param LoginAction $loginAction
     * @param array       $options
     */
    public function __construct(Client $client, LoginAction $loginAction, array $options)
    {
        if (!isset($options['userlist_link_text'])) {
            throw new InvalidConfigurationException('You must provide \'userlist_link_text\' option to UserList visitor.');
        }

        $this->client = $client;
        $this->loginAction = $loginAction;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function visit($pageNumber)
    {
        if ($this->firstPageCrawler === null) {
            $this->firstPageCrawler = $this->getFirstPageCrawler();
        }

        if ($pageNumber === 1) {
            $this->crawler = $this->firstPageCrawler;
        } else {
            $this->visitPage($pageNumber);
        }
    }

    /**
     * @return Crawler
     */
    private function getFirstPageCrawler()
    {
        $crawler = $this->loginAction->getActualCrawler();
        $linkCrawler = $crawler->selectLink($this->options['userlist_link_text']);

        return $this->client->click($linkCrawler->link());
    }

    /**
     * @param int $pageNumber
     */
    private function visitPage($pageNumber)
    {
        $crawler = $this->firstPageCrawler;
        $linkCrawler = $crawler->selectLink((string) $pageNumber);
        $this->crawler = $this->client->click($linkCrawler->link());
    }
}
