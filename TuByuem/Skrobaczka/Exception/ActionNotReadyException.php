<?php

namespace TuByuem\Skrobaczka\Exception;

use BadMethodCallException;
use TuByuem\Skrobaczka\Action\ActionInterface;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class ActionNotReadyException extends BadMethodCallException
{
    /**
     * @var ActionInterface
     */
    private $action;

    /**
     * @param ActionInterface $action
     */
    public function __construct(ActionInterface $action)
    {
        $this->action = $action;

        parent::__construct(
            sprintf(
                'Trying to get crawler from action %s before it was performed.',
                get_class($action)
            )
        );
    }

    /**
     * @return ActionInterface
     */
    public function getAction()
    {
        return $this->action;
    }
}
