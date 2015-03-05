<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class SearchAdminUser extends AbstractStaticVisitor
{
    /**
     * @var AdminMenu
     */
    private $adminMenuVisitor;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $options;

    /**
     * @param AdminMenu $adminMenuVisitor
     * @param Client    $client
     * @param array     $options
     */
    public function __construct(AdminMenu $adminMenuVisitor, Client $client, array $options)
    {
        if (
            !isset($options['manage_users_link_text']) ||
            !isset($options['user_section_caption']) ||
            !isset($options['cattitle_selector'])
        ) {
            throw new InvalidConfigurationException('\'manage_users_link_text\', \'user_section_caption\' and \'cattitle_selector\' options are required.');
        }
        $this->adminMenuVisitor = $adminMenuVisitor;
        $this->client = $client;
        $this->options = $options;
    }

    public function visit()
    {
        $this->adminMenuVisitor->visitIfNotReady();
        $adminMenuCrawler = $this->adminMenuVisitor->getActualCrawler();

        $this->crawler = $this->client->click($this->getManageUsersLink($adminMenuCrawler));
    }

    /**
     * @param Crawler $adminMenuCrawler
     *
     * @return Link
     */
    private function getManageUsersLink(Crawler $adminMenuCrawler)
    {
        $tdCrawler = $adminMenuCrawler->filter('td');
        $i = 0;
        try {
            $spanCrawler = null;
            while ($spanCrawler === null || $spanCrawler->text() !== $this->options['user_section_caption']) {
                $i++;
                $spanCrawler = $tdCrawler->eq($i)->filter('span');
            }
            $linkCrawler = null;
            while ($linkCrawler === null || $linkCrawler->text() !== $this->options['manage_users_link_text']) {
                $i++;
                $linkCrawler = $tdCrawler->eq($i)->filter('a');
            }
        } catch (InvalidArgumentException $e) {
            throw new InvalidConfigurationException('Check your configuration for \'admin_menu.options\'.');
        }

        return $linkCrawler->link();
    }

    /**
     * @param Crawler $linkCrawler
     *
     * @return string
     */
    private function getLastCategoryTitle(Crawler $linkCrawler)
    {
        return $linkCrawler->previousAll()->filter($this->options['cattitle_selector'])->last()->text();
    }
}
