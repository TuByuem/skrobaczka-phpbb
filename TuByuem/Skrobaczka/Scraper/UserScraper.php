<?php

namespace TuByuem\Skrobaczka\Scraper;

use TuByuem\Skrobaczka\Action\Helper\UserLinkFetcher;
use TuByuem\Skrobaczka\Action\Visitor\UserList;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class UserScraper implements MultiScraper
{
    /**
     * @var UserList
     */
    private $userListVisitor;

    /**
     * @var UserLinkFetcher
     */
    private $userLinkFetcher;

    public function __construct(UserList $userListVisitor, UserLinkFetcher $userLinkFetcher)
    {
        $this->userListVisitor = $userListVisitor;
        $this->userLinkFetcher = $userLinkFetcher;
    }

    public function scrap()
    {
        while ($this->userListVisitor->hasNextPage()) {
            $this->userListVisitor->visitNextPage();
            $actualPageCrawler = $this->userListVisitor->getActualCrawler();
            $actualPageLinkCrawlers = $this->userLinkFetcher->fetchUsernames($actualPageCrawler);
            var_dump($actualPageLinkCrawlers);
        }
    }
}
