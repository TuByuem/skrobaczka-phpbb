<?php

namespace TuByuem\Skrobaczka\Util;

use Symfony\Component\BrowserKit\Client;
use TuByuem\Skrobaczka\Action\Visitor\EditPost;
use TuByuem\Skrobaczka\Action\Visitor\Topic;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class EditPostVisitorFactory
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $editPostConfiguration;

    /**
     * @param Client $client
     * @param array  $editPostConfiguration
     */
    public function __construct(Client $client, array $editPostConfiguration)
    {
        $this->client = $client;
        $this->editPostConfiguration = $editPostConfiguration;
    }

    /**
     * @param type  $postId
     * @param Topic $topicVisitor
     *
     * @return EditPost
     */
    public function createEditPostVisitor($postId, Topic $topicVisitor)
    {
        $visitor = new EditPost($this->client, $this->editPostConfiguration);
        $visitor->init($topicVisitor, $postId);

        return $visitor;
    }
}
