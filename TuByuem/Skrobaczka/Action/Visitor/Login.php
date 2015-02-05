<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;
use TuByuem\Skrobaczka\Exception\ElementNotFoundException;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Login extends AbstractStaticVisitor
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var VisitMainpage
     */
    private $visitMainpageAction;

    /**
     * @var array
     */
    private $options;

    /**
     * @param \TuByuem\Skrobaczka\Action\Client $client
     * @param VisitMainpage                     $visitMainpageAction
     * @param array                             $options
     */
    public function __construct(Client $client, Mainpage $visitMainpageAction, $options)
    {
        if (!isset($options['link_text'])) {
            throw new InvalidConfigurationException('Action VisitLogin requires \'link_text\' option.');
        }
        $this->client = $client;
        $this->visitMainpageAction = $visitMainpageAction;
        $this->options = $options;
    }

    public function visit()
    {
        $crawler = $this->visitMainpageAction->getActualCrawler();
        $loginLink = $this->getLoginLink($crawler->selectLink($this->options['link_text']));
        $this->crawler = $this->client->click($loginLink);
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
}
