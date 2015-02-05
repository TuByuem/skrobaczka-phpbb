<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use TuByuem\Skrobaczka\Action\AbstractAction;
use TuByuem\Skrobaczka\Action\ActionInterface;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
abstract class AbstractPagedVisitor extends AbstractAction
{
    /**
     * @param ActionInterface $action
     * @param int             $pageNumber
     */
    abstract public function visit($pageNumber);
}
