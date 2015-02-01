<?php

namespace TuByuem\Skrobaczka\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TuByuem\Skrobaczka\Action\ActionInterface;

/**
 * Description of Scrap
 *
 * @author TuByuem <tubyuem@wp.pl>
 */
class Scrap extends Command
{
    /**
     * @var ActionInterface
     */
    private $loginAction;

    public function __construct(ActionInterface $loginAction)
    {
        $this->loginAction = $loginAction;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('skrobaczka:scrap')
                ->addArgument('address', InputArgument::REQUIRED, 'Adres forum do pobrania')
                ->addArgument('db', InputArgument::REQUIRED, 'Dane bazy do wypełnienia (uri PDO)')
                ->addArgument('login', InputArgument::REQUIRED, 'Login do konta administracyjnego')
                ->addArgument('password', InputArgument::REQUIRED, 'Hasło do konta administracyjnego');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->loginAction->perform([
            'url' => $input->getArgument('address'),
            'username' => $input->getArgument('login'),
            'password' => $input->getArgument('password'),
        ]);
    }
}
