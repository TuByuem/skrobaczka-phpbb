<?php

namespace TuByuem\Skrobaczka\Action;

use TuByuem\Skrobaczka\Action\Visitor\Mainpage;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Init extends AbstractAction
{
    /**
     * @var Mainpage
     */
    private $mainpageVisitor;

    /**
     * @var Login
     */
    private $loginAction;

    /**
     * @param Mainpage $mainpageVisitor
     * @param Login    $loginAction
     */
    public function __construct(Mainpage $mainpageVisitor, Login $loginAction)
    {
        $this->mainpageVisitor = $mainpageVisitor;
        $this->loginAction = $loginAction;
    }

    /**
     * @param string $url
     * @param string $username
     * @param string $password
     */
    public function init($url, $username, $password)
    {
        $this->mainpageVisitor->visit($url);
        $this->crawler = $this->loginAction->login($username, $password);
    }
}
