<?php

namespace TuByuem\Skrobaczka\Action;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
interface ActionInterface
{
    /**
     * @param array $options
     */
    public function perform(array $options);
}
