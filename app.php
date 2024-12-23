<?php

declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use Symfony\Component\Console\Application;
use Nakaoni\SymfonyCommandAsSubprocess\PrintCommand;
use Nakaoni\SymfonyCommandAsSubprocess\ProcessCommand;

$application = new Application();
$printCommand = new PrintCommand();
$processCommand = new ProcessCommand();

$application->add($printCommand);
$application->add($processCommand);

$application->run();

