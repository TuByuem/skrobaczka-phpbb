<?php

namespace TuByuem\Skrobaczka\Action\Helper;

use Closure;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class UserLinkFetcher
{
    /**
     * @param  Crawler $listPageCrawler
     * @return Link[]
     */
    public function fetchUserLinks(Crawler $listPageCrawler)
    {
        $links = [];
        $this->eachUserLink($listPageCrawler, function (Crawler $linkCrawler, $i) use (&$links) {
            $links[] = $linkCrawler->link();
        });

        return $links;
    }

    /**
     * @param  Crawler   $listPageCrawler
     * @return Crawler[]
     */
    public function fetchUserLinkCrawlers(Crawler $listPageCrawler)
    {
        $linkCrawlers = [];
        $this->eachUserLink($listPageCrawler, function (Crawler $linkCrawler, $i) use (&$linkCrawlers) {
            $linkCrawlers[] = $linkCrawler;
        });

        return $linkCrawlers;
    }

    /**
     * @param  Crawler $listPageCrawler
     * @return array
     */
    public function fetchUsernames(Crawler $listPageCrawler)
    {
        $usernames = [];
        $this->eachUserLink($listPageCrawler, function (Crawler $linkCrawler, $i) use (&$usernames) {
            /* @var $linkCrawler Crawler */
            $usernames[] = $linkCrawler->text();
        });

        return $usernames;
    }

    /**
     * @param Crawler $listPageCrawler
     * @param Closure $closure
     */
    private function eachUserLink(Crawler $listPageCrawler, Closure $closure)
    {
        $linkNodeListCrawler = $listPageCrawler->filter('table.forumline a.gentbl');
        $linkNodeListCrawler->each($closure);
    }
}
