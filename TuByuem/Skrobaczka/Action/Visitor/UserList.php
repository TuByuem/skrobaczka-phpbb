<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use Symfony\Component\BrowserKit\Client;
use TuByuem\Skrobaczka\Action\Login as LoginAction;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class UserList extends AbstractVisitor
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
     * @param array       $options
     */
    public function __construct(Client $client, LoginAction $loginAction, array $options)
    {
        if (!isset($options['userlist_link_text'])) {
            throw new InvalidConfigurationException('You must provide \'userlist_link_text\' option to UserList visitor.');
        }

        $this->client = $client;
        $this->loginAction = $loginAction;
        $this->options = $options;
    }

    public function visit()
    {
        $crawler = $this->loginAction->getCrawler();
        $linkCrawler = $crawler->selectLink($this->options['userlist_link_text']);
        $this->crawler = $this->client->click($linkCrawler->link());
    }
}
