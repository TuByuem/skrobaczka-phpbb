<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use TuByuem\Skrobaczka\Action\AbstractAction;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
abstract class AbstractUrlVisitor extends AbstractAction
{
    /**
     * @param string $url
     */
    abstract public function visit($url);
}
