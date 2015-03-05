<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use OutOfRangeException;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;
use TuByuem\Skrobaczka\Action\AbstractAction;
use TuByuem\Skrobaczka\Exception\ActionNotReadyException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
abstract class AbstractPagedVisitor extends AbstractAction
{
    /**
     * @var int
     */
    private $lastPageNumber;

    /**
     * @var int
     */
    private $nextPageNumber = 1;

    /**
     * @var Crawler
     */
    private $firstPageCrawler;

    /**
     * @var int
     */
    private $actualPageNumber;

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
     * @return boolean
     */
    public function hasNextPage()
    {
        if ($this->lastPageNumber === null) {
            $this->lastPageNumber = $this->getLastPageNumber();
        }

        return $this->nextPageNumber <= $this->lastPageNumber;
    }

    public function visitNextPage()
    {
        if ($this->lastPageNumber === null) {
            $this->lastPageNumber = $this->getLastPageNumber();
        }
        if (!$this->hasNextPage()) {
            throw new OutOfRangeException('Visitor has no next page to visit!');
        }

        if ($this->nextPageNumber === 1) {
            $this->crawler = $this->getFirstPageCrawler();
        } else {
            $this->visitPage($this->nextPageNumber);
        }
        $this->actualPageNumber = $this->nextPageNumber;
        $this->nextPageNumber++;
    }

    public function rewind()
    {
        $this->nextPageNumber = 1;
    }

    /**
     * @return int
     */
    public function getActualPageNumber()
    {
        return $this->actualPageNumber;
    }

    /**
     * @return Crawler Crawler for the link to the first page
     */
    abstract protected function getFirstPageLink();

    /**
     * @return int
     */
    private function getLastPageNumber()
    {
        $firstPageCrawler = $this->getFirstPageCrawler();
        $pageLinksCrawler = $firstPageCrawler->filter('td[align="right"] span.nav a');
        if (count($pageLinksCrawler) === 0) {
            return 1;
        }
        $lastLinkCrawler = $pageLinksCrawler->eq(count($pageLinksCrawler) - 2);

        return (int) $lastLinkCrawler->text();
    }

    /**
     * @return Crawler
     */
    private function getFirstPageCrawler()
    {
        if ($this->firstPageCrawler === null) {
            $this->firstPageCrawler = $this->client->click($this->getFirstPageLink()->link());
        }

        return $this->firstPageCrawler;
    }

    /**
     * @param int $pageNumber
     */
    private function visitPage($pageNumber)
    {
        try {
            $crawler = $this->getActualCrawler();
        } catch (ActionNotReadyException $ex) {
            $crawler = $this->firstPageCrawler;
        }

        $linkCrawler = $crawler->selectLink((string) $pageNumber);
        $this->crawler = $this->client->click($linkCrawler->link());
    }
}
