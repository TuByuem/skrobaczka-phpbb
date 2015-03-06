<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\DomCrawler\Link;
use TuByuem\Skrobaczka\Exception\InvalidConfigurationException;
use TuByuem\Skrobaczka\Util\TopicVisitorFactory;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class EditPost extends AbstractStaticVisitor
{
    /**
     * @var string
     */
    private $editButtonTitle;

    /**
     * @var string
     */
    private $postIdFromEditUrlRegex;

    /**
     * @var Topic
     */
    private $topicVisitor;

    /**
     * @var int
     */
    private $postId;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param array $configuration
     *
     * @throws InvalidConfigurationException
     */
    public function __construct(Client $client, array $configuration)
    {
        if (!isset($configuration['id_from_edit']) || !isset($configuration['edit_button_title'])) {
            throw new InvalidConfigurationException(
                'Invalid configuration for EditPostVisitor. Required fields are id_from_edit and edit_button_title!'
            );
        }

        $this->client = $client;
        $this->postIdFromEditUrlRegex = $configuration['id_from_edit'];
        $this->editButtonTitle = $configuration['edit_button_title'];
    }

    /**
     * @param Topic $topicVisitor
     * @param int   $postId
     */
    public function init(Topic $topicVisitor, $postId)
    {
        $this->postId = $postId;
        $this->topicVisitor = $topicVisitor;
    }

    /**
     * @return TopicVisitorFactory
     */
    public function getTopicVisitor()
    {
        return $this->topicVisitor;
    }

    public function visit()
    {
        $crawler = $this->topicVisitor->getActualCrawler();
        $buttonsCrawler = $crawler->filter(sprintf('img[title="%s"]', $this->editButtonTitle));
        $i = 0;
        do {
            $buttonCrawler = $buttonsCrawler->eq($i);
            try {
                $editLink = $buttonCrawler->parents()->link();
            } catch (InvalidArgumentException $ex) {
                throw new RuntimeException(
                    sprintf(
                        'Could not get link from button in topic %s (page: %d).',
                        $this->topicVisitor->getTopicTitle(),
                        $this->topicVisitor->getActualPageNumber()
                    )
                );
            }
            $i++;
        } while ($buttonCrawler->count() > 0 && !$this->testRegex($editLink));

        if ($buttonCrawler->count() == 0) {
            throw new RuntimeException(
                'Could not find post with id %d in topic %s (page: %d)',
                $this->postId,
                $this->topicVisitor->getTopicTitle(),
                $this->topicVisitor->getActualPageNumber()
            );
        }
        $this->crawler = $this->client->click($editLink);
    }

    /**
     * @param Link $editLink
     *
     * @return boolean
     *
     * @throws InvalidConfigurationException
     */
    public function testRegex(Link $editLink)
    {
        $matches = [];
        $result = preg_match($this->postIdFromEditUrlRegex, $editLink->getUri(), $matches);
        if (!$result) {
            throw new InvalidConfigurationException('Post id regex does not match edit url.');
        }

        return (int) $matches[1] === $this->postId;
    }
}
