<?php

namespace TuByuem\Skrobaczka\Scraper;

use TuByuem\Skrobaczka\Action\AbstractAction;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
interface SingleScraper
{
    /**
     * @param AbstractAction $action Initialized action that returns crawler for the page to scrap
     *
     * @return Object Model object
     */
    public function scrap(AbstractAction $action);
}
