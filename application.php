<?php

require_once './vendor/autoload.php';
require_once './initContainer.php';

use Symfony\Component\Console\Application;

$application = new Application();
$application->run();

