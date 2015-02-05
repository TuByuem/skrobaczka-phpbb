<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use Symfony\Component\BrowserKit\Client;
use TuByuem\Skrobaczka\Action\Login as LoginAction;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class AdminLogin extends AbstractVisitor
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var LoginAction
     */
    private $loginAction;

    /**
     * @var array
     */
    private $options;

    /**
     * @param Client      $client
     * @param LoginAction $loginAction
     * @param type        $options
     */
    public function __construct(Client $client, LoginAction $loginAction, $options)
    {
        if (!isset($options['link_text'])) {
            throw new InvalidConfigurationException('VisitAdminPanel action requires \'link_text\' option.');
        }

        $this->client = $client;
        $this->loginAction = $loginAction;
        $this->options = $options;
    }

    public function visit()
    {
        $loginCrawler = $this->loginAction->getCrawler();
        $linkCrawler = $loginCrawler->selectLink($this->options['link_text']);
        $link = $linkCrawler->link();

        $this->crawler = $this->client->click($link);
    }
}
