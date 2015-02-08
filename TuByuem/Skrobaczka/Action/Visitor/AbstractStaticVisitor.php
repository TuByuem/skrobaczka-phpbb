<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use TuByuem\Skrobaczka\Action\AbstractAction;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
abstract class AbstractStaticVisitor extends AbstractAction
{
    abstract public function visit();

    public function visitIfNotReady()
    {
        if (!$this->isReady()) {
            $this->visit();
        }
    }
}
