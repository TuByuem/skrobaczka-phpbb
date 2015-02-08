<?php

namespace TuByuem\Skrobaczka\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TuByuem\Skrobaczka\Action\AdminLogin;
use TuByuem\Skrobaczka\Action\Init;
use TuByuem\Skrobaczka\Action\Visitor\AdminMenu;

/**
 * @author TuByuem <tubyuem@wp.pl>
 */
class Scrap extends Command
{
    /**
     * @var Init
     */
    private $init;

    /**
     * @var AdminMenu
     */
    private $adminMenuVisitor;

    /**
     * @var AdminLogin
     */
    private $adminLoginAction;

    public function __construct(Init $init, AdminMenu $adminMenuVisitor, AdminLogin $adminLoginAction)
    {
        $this->init = $init;
        $this->adminMenuVisitor = $adminMenuVisitor;
        $this->adminLoginAction = $adminLoginAction;
        parent::__construct();
    }

    public function configure()
    {
        $this->setName('skrobaczka:scrap')
                ->addArgument('address', InputArgument::REQUIRED, 'Adres forum do pobrania')
                ->addArgument('db', InputArgument::REQUIRED, 'Dane bazy do wypełnienia (uri PDO)')
                ->addArgument('username', InputArgument::REQUIRED, 'Login do konta administracyjnego')
                ->addArgument('password', InputArgument::REQUIRED, 'Hasło do konta administracyjnego');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $this->init->init(
            $input->getArgument('address'),
            $username,
            $password
        );
        $this->adminLoginAction->login($username, $password);
        $this->adminMenuVisitor->visit();
        $output->writeln($this->adminMenuVisitor->getActualCrawler()->html());
    }
}
