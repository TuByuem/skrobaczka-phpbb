<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use Symfony\Component\BrowserKit\Client;
use TuByuem\Skrobaczka\Action\AdminLogin as AdminLoginAction;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class AdminMenu extends AbstractStaticVisitor
{
    /**
     * @var AdminLoginAction
     */
    private $adminLoginAction;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param AdminLoginAction $adminLoginAction
     * @param Client           $client
     */
    public function __construct(AdminLoginAction $adminLoginAction, Client $client)
    {
        $this->adminLoginAction = $adminLoginAction;
        $this->client = $client;
    }

    public function visit()
    {
        $loginCrawler = $this->adminLoginAction->getActualCrawler();
        $menuFrame = $loginCrawler->filter('frame')->eq(0);
        $this->crawler = $this->client->request('GET', $menuFrame->attr('src'));
    }
}
