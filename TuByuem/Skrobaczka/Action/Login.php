<?php

namespace TuByuem\Skrobaczka\Action;

use InvalidArgumentException;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Login implements ActionInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $loginPath;

    /**
     * @var string
     */
    private $loginButtonText;

    /**
     * @param Client $client
     * @param string $loginPath
     * @param string $loginButtonText
     */
    public function __construct(Client $client, $loginPath, $loginButtonText)
    {
        $this->client = $client;
        $this->loginPath = $loginPath;
        $this->loginButtonText = $loginButtonText;
    }

    /**
     * @param  array                    $options
     * @throws InvalidArgumentException
     */
    public function perform(array $options)
    {
        if (!isset($options['url']) || !isset($options['username']) || !isset($options['password'])) {
            throw new InvalidArgumentException('Required options are username and passwords.');
        }

        $crawler = $this->getLoginCrawler($options['url']);
        $this->submitForm($crawler, $options['username'], $options['password']);
    }

    /**
     * @return Crawler
     */
    private function getLoginCrawler($url)
    {
        return $this->client->request('GET', sprintf('%s/%s', $url, $this->loginPath));
    }

    /**
     * @param Crawler $crawler
     */
    private function submitForm(Crawler $crawler, $username, $password)
    {
        $buttonCrawlerNode = $crawler->selectButton($this->loginButtonText);
        $form = $buttonCrawlerNode->form(
            [
                'username' => $username,
                'password' => $password,
            ]
        );
        $resultCrawler = $this->client->submit($form);
        echo $resultCrawler->html();
    }
}
