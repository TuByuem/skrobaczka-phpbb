<?php

namespace TuByuem\Skrobaczka\Mapping;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
interface MappingInterface
{
    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function mapToModel($value);
}
