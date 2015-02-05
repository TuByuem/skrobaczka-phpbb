<?php

namespace TuByuem\Skrobaczka\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TuByuem\Skrobaczka\Action\Login;
use TuByuem\Skrobaczka\Action\VisitMainpage;

/**
 * Description of Scrap
 *
 * @author TuByuem <tubyuem@wp.pl>
 */
class Scrap extends Command
{
    /**
     * @var VisitMainpage
     */
    private $visitMainpage;

    /**
     * @var Login
     */
    private $loginAction;

    /**
     * @param VisitMainpage $visitMainpage
     * @param Login         $loginAction
     */
    public function __construct(VisitMainpage $visitMainpage, Login $loginAction)
    {
        $this->visitMainpage = $visitMainpage;
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
        $this->visitMainpage->visit($input->getArgument('address'));
        $this->loginAction->login($input->getArgument('login'), $input->getArgument('password'));
    }
}
