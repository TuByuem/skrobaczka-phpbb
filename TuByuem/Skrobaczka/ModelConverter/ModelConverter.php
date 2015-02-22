<?php

namespace TuByuem\Skrobaczka\ModelConverter;

use Symfony\Component\PropertyAccess\PropertyAccessor;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;
use TuByuem\Skrobaczka\Mapping\MappingInterface;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class ModelConverter
{
    /**
     * @var PropertyAccessor
     */
    private $propertyAccessor;

    /**
     * @var string
     */
    private $modelClassName;

    /**
     * @var array
     */
    private $objectMapping;

    /**
     * @var MappingInterface[]
     */
    private $mappings = [];

    /**
     * @param string $modelClassName
     */
    public function __construct($modelClassName)
    {
        $this->modelClassName = $modelClassName;
    }

    /**
     * @param PropertyAccessor $propertyAccessor
     */
    public function setPropertyAccessor(PropertyAccessor $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @param array $objectMapping
     */
    public function setObjectMapping($objectMapping)
    {
        $this->objectMapping = $objectMapping;
    }

    /**
     * @param MappingInterface $mapping
     * @param string           $alias
     */
    public function addMapping(MappingInterface $mapping, $alias)
    {
        $this->mappings[$alias] = $mapping;
    }

    public function convert(array $data)
    {
        $model = new $this->modelClassName();

        foreach ($this->objectMapping[$this->modelClassName] as $propertyName => $fieldData) {
            $fieldName = $fieldData['field'];
            if (!$this->propertyAccessor->isWritable($model, $propertyName)) {
                throw new InvalidConfigurationException(sprintf('Invalid mapping for %s. Property %s seems to be not writable.', $this->modelClassName, $propertyName));
            }
            if (!isset($data[$fieldName])) {
                throw new InvalidConfigurationException(sprintf('Invalid mapping for %s. Value %s was not provided.', $this->modelClassName, $fieldName));
            }
            if (isset($fieldData['mapping'])) {
                $mappedValue = $this->mappings[$fieldData['mapping']]->mapToModel($data[$fieldName]);
            } else {
                $mappedValue = $data[$fieldName];
            }

            $this->propertyAccessor->setValue($model, $propertyName, $mappedValue);
        }

        return $model;
    }

    private function validateObjectMapping(array $objectMapping)
    {
    }
}
