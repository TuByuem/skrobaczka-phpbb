<?php

require_once './vendor/autoload.php';
require_once './initContainer.php';

use Symfony\Component\Console\Application;

$application = new Application();
/* @var $container Symfony\Component\DependencyInjection\Container */
if ($container->hasParameter('console.command.ids')) {
    foreach ($container->getParameter('console.command.ids') as $commandId) {
        $application->add($container->get($commandId));
    }
}
$application->run();

