<?php

use Symfony\Bundle\FrameworkBundle\DependencyInjection\Compiler\AddConsoleCommandPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new DependencyInjection\ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config'));
$loader->load('services.yml');
$loader->load('parameters.yml');

$container->addCompilerPass(new AddConsoleCommandPass());
$container->compile();
