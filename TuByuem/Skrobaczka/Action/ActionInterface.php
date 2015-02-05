<?php

namespace TuByuem\Skrobaczka\Action;

use Symfony\Component\DomCrawler\Crawler;
use TuByuem\Skrobaczka\Exception\ActionNotReadyException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
interface ActionInterface
{
    /**
     * @return Crawler
     * @throws ActionNotReadyException
     */
    public function getCrawler();
}
