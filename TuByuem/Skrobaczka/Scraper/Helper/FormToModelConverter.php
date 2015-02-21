<?php

namespace TuByuem\Skrobaczka\Scraper\Helper;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class FormToModelConverter
{
    /**
     * @var PropertyAccessor
     */
    private $accessor;

    /**
     * @var string
     */
    private $className;

    /**
     * @var array
     */
    private $mapping;

    public function __construct(PropertyAccessor $accessor, $className)
    {
        $this->accessor = $accessor;
        $this->className = $className;
    }

    public function setMapping($mapping)
    {
        $this->mapping = $mapping;
    }

    public function convert(array $data)
    {
        $model = new $this->className();
        foreach ($this->mapping[$this->className] as $propertyName => $fieldName) {
            if (!$this->accessor->isWritable($model, $propertyName)) {
                throw new InvalidConfigurationException(sprintf('Invalid mapping for %s. Property %s seems to be not writable.', $this->className, $propertyName));
            }
            if (!isset($data[$fieldName])) {
                throw new InvalidConfigurationException(sprintf('Invalid mapping for %s. Field %s is not present in form.', $this->className, $fieldName));
            }
            $this->accessor->setValue($model, $propertyName, $data[$fieldName]);
        }

        return $model;
    }
}
