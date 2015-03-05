<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use RuntimeException;
use Symfony\Component\BrowserKit\Client;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Forum extends AbstractPagedVisitor
{
    /**
     * @var string
     */
    private $forumName;

    /**
     * @var Mainpage
     */
    private $mainpageVisitor;

    /**
     * @param Client   $client
     * @param Mainpage $mainpageVisitor
     */
    public function __construct(Client $client, Mainpage $mainpageVisitor)
    {
        $this->mainpageVisitor = $mainpageVisitor;
        parent::__construct($client);
    }

    public function initForForum($forumName)
    {
        if ($this->forumName !== null) {
            throw new RuntimeException('ForumVisitor is already initialized.');
        }

        $this->forumName = $forumName;
    }

    /**
     * {@inheritdoc}
     */
    protected function getFirstPageLink()
    {
        if ($this->forumName === null) {
            throw new RuntimeException('ForumVisitor not initialized.');
        }

        $crawler = $this->mainpageVisitor->getActualCrawler();

        return $crawler->filter('.forumlink a')->selectLink($this->forumName);
    }
}
