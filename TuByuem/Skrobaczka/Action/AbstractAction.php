<?php

namespace TuByuem\Skrobaczka\Action;

use Symfony\Component\DomCrawler\Crawler;
use TuByuem\Skrobaczka\Exception\ActionNotReadyException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
abstract class AbstractAction implements ActionInterface
{
    /**
     * @var Crawler
     */
    protected $crawler;

    /**
     * @return Crawler
     *
     * @throws ActionNotReadyException
     */
    public function getActualCrawler()
    {
        if ($this->crawler === null) {
            throw new ActionNotReadyException($this);
        }

        return $this->crawler;
    }

    /**
     * @return boolean
     */
    public function isReady()
    {
        return $this->crawler !== null;
    }
}
