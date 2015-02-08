<?php

namespace TuByuem\Skrobaczka\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TuByuem\Skrobaczka\Action\AdminLogin;
use TuByuem\Skrobaczka\Action\Init;
use TuByuem\Skrobaczka\Action\Visitor\SearchAdminUser;

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
     * @var SearchAdminUser
     */
    private $searchAdminUserVisitor;

    /**
     * @var AdminLogin
     */
    private $adminLoginAction;

    public function __construct(Init $init, SearchAdminUser $searchAdminUserVisitor, AdminLogin $adminLoginAction)
    {
        $this->init = $init;
        $this->searchAdminUserVisitor = $searchAdminUserVisitor;
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
        $this->searchAdminUserVisitor->visit();
        $output->writeln($this->searchAdminUserVisitor->getActualCrawler()->html());
    }
}
