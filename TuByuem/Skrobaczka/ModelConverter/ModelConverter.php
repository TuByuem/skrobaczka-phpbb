<?php

namespace TuByuem\Skrobaczka\ModelConverter;

use Symfony\Component\PropertyAccess\PropertyAccessor;

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
     * @param PropertyAccessor $propertyAccessor
     */
    public function __construct(PropertyAccessor $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @param string $modelClassName
     */
    public function setModelClassName($modelClassName)
    {
        $this->modelClassName = $modelClassName;
    }

    /**
     * @param array $objectMapping
     */
    public function setObjectMapping(array $objectMapping)
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

    private function validateObjectMapping(array $objectMapping)
    {
    }
}
