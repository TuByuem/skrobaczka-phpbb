<?php

namespace TuByuem\Skrobaczka\Action\Helper;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class SubmitLoginForm
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $options;

    /**
     * @param Client $client
     */
    public function __construct(Client $client, array $options)
    {
        if (!isset($options['button_text'])) {
            throw new InvalidConfigurationException(
                'Helper SubmitLoginForm requires \'button_text\' option.'
            );
        }

        $this->options = $options;
        $this->client = $client;
    }

    /**
     * @param Crawler $crawler
     * @param string  $username
     * @param string  $password
     */
    public function submitForm(Crawler $crawler, $username, $password)
    {
        $buttonCrawlerNode = $crawler->selectButton($this->options['button_text']);
        $form = $buttonCrawlerNode->form(
            [
                'username' => $username,
                'password' => $password,
            ]
        );

        return $this->client->submit($form);
    }
}
