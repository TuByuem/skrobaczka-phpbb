<?php

namespace TuByuem\Skrobaczka\Action;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Init extends AbstractAction
{
    /**
     * @var VisitMainpage
     */
    private $visitMainpageAction;

    /**
     * @var Login
     */
    private $loginAction;

    /**
     * @param VisitMainpage $visitMainpageAction
     * @param Login         $loginAction
     */
    public function __construct(VisitMainpage $visitMainpageAction, Login $loginAction)
    {
        $this->visitMainpageAction = $visitMainpageAction;
        $this->loginAction = $loginAction;
    }

    /**
     * @param string $url
     * @param string $username
     * @param string $password
     */
    public function init($url, $username, $password)
    {
        $this->visitMainpageAction->visit($url);
        $this->crawler = $this->loginAction->login($username, $password);
    }
}
