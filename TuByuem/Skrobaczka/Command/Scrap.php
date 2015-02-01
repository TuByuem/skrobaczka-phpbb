<?php

namespace TuByuem\Skrobaczka\Command;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of Scrap
 *
 * @author TuByuem <tubyuem@wp.pl>
 */
class Scrap extends Command
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('skrobaczka:scrap');
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $crawler = $this->client->request('GET', 'http://www.google.pl/');
        var_dump($crawler->html());
    }
}
