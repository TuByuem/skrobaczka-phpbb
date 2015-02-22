<?php

namespace TuByuem\Skrobaczka\Scraper;

use TuByuem\Skrobaczka\Action\AbstractAction;
use TuByuem\Skrobaczka\ModelConverter\ModelConverter;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
abstract class SingleScraper
{
    /**
     * @var ModelConverter
     */
    private $converter;

    /**
     * @param ModelConverter $converter
     */
    public function __construct(ModelConverter $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @param array $values
     *
     * @return object
     */
    protected function convert(array $values)
    {
        return $this->converter->convert($values);
    }

    /**
     * @param AbstractAction $action Initialized action that returns crawler for the page to scrap
     *
     * @return Object Model object
     */
    abstract public function scrap(AbstractAction $action);
}
