<?php

namespace TuByuem\Skrobaczka\Scraper\Helper;

use Symfony\Component\DomCrawler\Crawler;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class FormScraper
{
    public function scrapFormFields(Crawler $crawler)
    {
        $textInputs = $crawler->filter('input, textarea, select');
        $textModels = $this->convertInputsToModels($textInputs);
        var_dump($textModels);
    }

    private function convertInputsToModels(Crawler $inputsCrawler)
    {
        $fields = [];
        $i = 0;
        $fieldCount = count($inputsCrawler);
        while ($i < $fieldCount) {
            $inputCrawler = $inputsCrawler->eq($i);
            $i++;
            if (!$this->isEnabled($inputCrawler)) {
                continue;
            }
            $fieldName = $this->convertName($inputCrawler);
            $fieldValue = $this->convertValue($inputCrawler);
            $fields[$fieldName] = $fieldValue;
        }

        return $fields;
    }

    private function isEnabled(Crawler $input)
    {
        if ($input->nodeName() === 'input' && $input->attr('type') === 'radio') {
            return $input->attr('checked') === 'checked';
        } else {
            return true;
        }
    }
    private function convertName(Crawler $inputCrawler)
    {
        return $inputCrawler->attr('name');
    }

    private function convertValue(Crawler $inputCrawler)
    {
        switch ($inputCrawler->nodeName()) {
            case 'textarea':
                return $inputCrawler->text();
            case 'select':
                return $this->getActiveOptionValue($inputCrawler);
            case 'input':
                return $inputCrawler->attr('value');
        }
    }

    private function getActiveOptionValue(Crawler $selectCrawler)
    {
        $options = $selectCrawler->filter('option');
        $i = 0;
        $optionCount = count($options);
        while ($i < $optionCount) {
            $option = $options->eq($i);
            if ($option->attr('selected') === 'selected') {
                return $option->attr('value');
            }
            $i++;
        }

        return;
    }
}
