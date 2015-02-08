<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;
use TuByuem\Skrobaczka\Action\Login as LoginAction;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class UserList extends AbstractPagedVisitor
{
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

        $this->loginAction = $loginAction;
        $this->options = $options;

        parent::__construct($client);
    }

    /**
     * {@inheritdoc}
     */
    protected function getFirstPageLink()
    {
        $crawler = $this->loginAction->getActualCrawler();

        return $crawler->selectLink($this->options['userlist_link_text']);
    }
}
