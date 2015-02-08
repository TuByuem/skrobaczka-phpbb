<?php

namespace TuByuem\Skrobaczka\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TuByuem\Skrobaczka\Action\AdminLogin;
use TuByuem\Skrobaczka\Action\FindAdminUserPage;
use TuByuem\Skrobaczka\Action\Init;

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
     * @var FindAdminUserPage
     */
    private $findAdminUserPageAction;

    /**
     * @var AdminLogin
     */
    private $adminLoginAction;

    /**
     * @param Init              $init
     * @param FindAdminUserPage $findAdminUserPageAction
     * @param AdminLogin        $adminLoginAction
     */
    public function __construct(Init $init, FindAdminUserPage $findAdminUserPageAction, AdminLogin $adminLoginAction)
    {
        $this->init = $init;
        $this->findAdminUserPageAction = $findAdminUserPageAction;
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
        $this->findAdminUserPageAction->find('TuByuem');
        $output->writeln($this->findAdminUserPageAction->getActualCrawler()->html());
    }
}
