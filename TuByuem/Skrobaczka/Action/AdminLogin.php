<?php

namespace TuByuem\Skrobaczka\Action;

use TuByuem\Skrobaczka\Action\Helper\SubmitLoginForm;
use TuByuem\Skrobaczka\Action\Visitor\AdminLogin as AdminLoginVisitor;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class AdminLogin extends AbstractAction
{
    /**
     * @var SubmitLoginForm
     */
    private $loginFormHelper;

    /**
     * @var AdminLoginVisitor
     */
    private $adminLoginVisitor;

    /**
     * @var array
     */
    private $options;

    /**
     * @param AdminLoginVisitor $adminLoginVisitor
     * @param SubmitLoginForm   $loginFormHelper
     */
    public function __construct(
        AdminLoginVisitor $adminLoginVisitor,
        SubmitLoginForm $loginFormHelper
    ) {
        $this->adminLoginVisitor = $adminLoginVisitor;
        $this->loginFormHelper = $loginFormHelper;
    }

    public function login($username, $password)
    {
        $this->adminLoginVisitor->visit();
        $loginCrawler = $this->adminLoginVisitor->getActualCrawler();
        $this->crawler = $this->loginFormHelper->submitForm($loginCrawler, $username, $password);
    }
}
