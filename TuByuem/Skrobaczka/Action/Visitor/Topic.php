<?php

namespace TuByuem\Skrobaczka\Action\Visitor;

use RuntimeException;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\DomCrawler\Link;
use Symfony\Component\PropertyAccess\Exception\InvalidArgumentException;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Topic extends AbstractPagedVisitor
{
    /**
     * @var Forum
     */
    private $forumVisitor;

    /**
     * @var string
     */
    private $topicTitle;

    /**
     * @param string $topicTitle
     * @param Forum  $forumVisitor
     *
     * @throws RuntimeException
     */
    public function initForTopic($topicTitle, Forum $forumVisitor)
    {
        if ($this->topicTitle !== null) {
            throw new RuntimeException('Topic visitor is already initialized.');
        }

        $this->topicTitle = $topicTitle;
        $this->forumVisitor = $forumVisitor;
    }

    /**
     * @return Link
     *
     * @throws RuntimeException
     */
    protected function getFirstPageLink()
    {
        if ($this->topicTitle === null) {
            throw new RuntimeException('Topic visitor needs to be initialized first.');
        }

        $topicLinks = $this->forumVisitor->getActualCrawler()->filter('a.topictitle');
        /* @var $topicLinkCrawler Crawler */
        $topicLinkCrawler = null;
        $i = 0;
        while ($topicLinkCrawler === null || $topicLinkCrawler->text() !== $this->topicTitle) {
            $i++;
            try {
                $topicLinkCrawler = $topicLinks->eq($i);
            } catch (InvalidArgumentException $e) {
                throw new RuntimeException(
                    sprintf(
                        'Topic %s in forum %s (page %d) could not be found.',
                        $this->topicTitle,
                        $this->forumVisitor->getForumName(),
                        $this->forumVisitor->getActualPageNumber()
                    )
                );
            }
        }

        return $topicLinkCrawler;
    }
}
