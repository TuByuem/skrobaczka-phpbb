<?php

namespace TuByuem\Skrobaczka\Action;

use Symfony\Component\BrowserKit\Client;
use TuByuem\Skrobaczka\Action\Visitor\SearchAdminUser;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class FindAdminUserPage extends AbstractAction
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var SearchAdminUser
     */
    private $searchAdminUserVisitor;

    /**
     * @var array
     */
    private $options;

    /**
     * @param Client          $client
     * @param SearchAdminUser $searchAdminUserVisitor
     * @param array           $options
     */
    public function __construct(Client $client, SearchAdminUser $searchAdminUserVisitor, array $options)
    {
        if (!isset($options['show_user_button_text'])) {
            throw new \TuByuem\Skrobaczka\Exception\InvalidConfigurationException('\'show_user_button_text\' option is required.');
        }
        $this->client = $client;
        $this->searchAdminUserVisitor = $searchAdminUserVisitor;
        $this->options = $options;
    }

    /**
     * @param string $username
     */
    public function find($username)
    {
        $this->searchAdminUserVisitor->visitIfNotReady();
        $crawler = $this->searchAdminUserVisitor->getActualCrawler();
        $buttonCrawler = $crawler->selectButton($this->options['show_user_button_text']);
        $form = $buttonCrawler->form();

        $form->setValues(['username' => $username]);
        $this->crawler = $this->client->submit($form);
    }
}
