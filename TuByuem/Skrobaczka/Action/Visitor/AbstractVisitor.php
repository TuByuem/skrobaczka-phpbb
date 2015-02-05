<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use TuByuem\Skrobaczka\Action\AbstractAction;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
abstract class AbstractVisitor extends AbstractAction
{
    abstract public function visit();
}
