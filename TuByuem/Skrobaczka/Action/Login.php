<?php

namespace TuByuem\Skrobaczka\Action;

use TuByuem\Skrobaczka\Action\Helper\SubmitLoginForm;
use TuByuem\Skrobaczka\Action\Visitor\Login as LoginVisitor;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Login extends AbstractAction
{
    /**
     * @var LoginVisitor
     */
    private $loginVisitor;

    /**
     * @var SubmitLoginForm
     */
    private $loginFormHelper;

    /**
     * @param LoginVisitor    $loginVisitor
     * @param SubmitLoginForm $loginFormHelper
     */
    public function __construct(
        LoginVisitor $loginVisitor,
        SubmitLoginForm $loginFormHelper
    ) {
        $this->loginVisitor = $loginVisitor;
        $this->loginFormHelper = $loginFormHelper;
    }

    public function login($username, $password)
    {
        $this->loginVisitor->visit();
        $loginCrawler  = $this->loginVisitor->getActualCrawler();
        $this->crawler = $this->loginFormHelper->submitForm($loginCrawler, $username, $password);
    }
}
