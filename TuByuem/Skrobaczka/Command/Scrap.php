<?php

namespace TuByuem\Skrobaczka\Command;

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
    public function __construct()
    {
        parent::__construct();
    }

    public function configure() {
        $this->setName('skrobaczka:scrap');
    }

    public function run(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('test');
    }
}
