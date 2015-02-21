<?php

namespace TuByuem\Skrobaczka\Mapping;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Boolean implements MappingInterface
{
    /**
     * @param string $value
     *
     * @return boolean
     */
    public function mapToModel($value)
    {
        return $value === '1';
    }
}
