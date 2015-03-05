<?php

namespace TuByuem\Skrobaczka\Util;

use Symfony\Component\BrowserKit\Client;
use TuByuem\Skrobaczka\Action\Visitor\Forum;
use TuByuem\Skrobaczka\Action\Visitor\Mainpage;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class ForumVisitorFactory
{
    /**
     * @var Client
     */
    private $client;

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
        $this->client = $client;
        $this->mainpageVisitor = $mainpageVisitor;
    }

    /**
     * @param string $forumName
     *
     * @return Forum
     */
    public function createForumVisitor($forumName)
    {
        $visitor = new Forum($this->client, $this->mainpageVisitor);
        $visitor->initForForum($forumName);

        return $visitor;
    }
}
