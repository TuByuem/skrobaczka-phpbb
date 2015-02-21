<?php

namespace TuByuem\Skrobaczka\Mapping;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Integer implements MappingInterface
{
    /**
     * @param string $value
     *
     * @return boolean
     */
    public function mapToModel($value)
    {
        return (int) $value;
    }
}
