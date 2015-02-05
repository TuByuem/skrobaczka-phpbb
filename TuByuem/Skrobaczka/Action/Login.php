<?php

namespace TuByuem\Skrobaczka\Action;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;
use TuByuem\Skrobaczka\Exception\ElementNotFoundException;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Login extends AbstractAction
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var VisitMainpage
     */
    private $visitMainpage;

    /**
     * @var array
     */
    private $options;

    /**
     * @param Client        $client
     * @param VisitMainpage $visitMainpage
     * @param array         $options
     */
    public function __construct(Client $client, VisitMainpage $visitMainpage, array $options)
    {
        if (!isset($options['link_text']) || !isset($options['button_text'])) {
            throw new InvalidConfigurationException(
                'LoginAction requires \'link_text\' and \'button_text\' as options.'
            );
        }

        $this->client = $client;
        $this->visitMainpage = $visitMainpage;
        $this->options = $options;
    }

    public function login($username, $password)
    {
        $loginCrawler = $this->getLoginCrawler();
        $this->submitForm($loginCrawler, $username, $password);
    }

    /**
     * @return Crawler
     */
    private function getLoginCrawler()
    {
        $mainpageCrawler = $this->visitMainpage->getCrawler();
        $linkCrawler = $mainpageCrawler->selectLink($this->options['link_text']);
        $link = $this->getLoginLink($linkCrawler);

        return $this->client->click($link);
    }

    /**
     * @param  Crawler                  $crawler
     * @return Link
     * @throws ElementNotFoundException
     */
    private function getLoginLink(Crawler $crawler)
    {
        $links = $crawler->links();
        foreach ($links as $link) {
            if ($link->getNode()->textContent === $this->options['link_text']) {
                return $link;
            }
        }

        throw new ElementNotFoundException('Login link could not be found.');
    }

    /**
     * @param Crawler $crawler
     */
    private function submitForm(Crawler $crawler, $username, $password)
    {
        $buttonCrawlerNode = $crawler->selectButton($this->options['button_text']);
        $form = $buttonCrawlerNode->form(
            [
                'username' => $username,
                'password' => $password,
            ]
        );
        $this->crawler = $this->client->submit($form);
        die($this->crawler->html());
    }
}
