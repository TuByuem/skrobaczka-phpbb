<?php

namespace TuByuem\Skrobaczka\Model;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
abstract class FormField
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    abstract public function getValue();
}
