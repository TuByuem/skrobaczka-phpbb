<?php

namespace TuByuem\Skrobaczka\Util;

use Symfony\Component\BrowserKit\Client;
use TuByuem\Skrobaczka\Action\Visitor\Forum;
use TuByuem\Skrobaczka\Action\Visitor\Topic;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class TopicVisitorFactory
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $topicTitle
     * @param Forum  $forumVisitor
     *
     * @return Topic
     */
    public function createTopicVisitor($topicTitle, Forum $forumVisitor)
    {
        $visitor = new Topic($this->client);
        $visitor->initForTopic($topicTitle, $forumVisitor);

        return $visitor;
    }
}
