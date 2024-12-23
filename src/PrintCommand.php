<?php

declare(strict_types=1);

namespace Nakaoni\SymfonyCommandAsSubprocess;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class PrintCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName("app:print")
            ->setDescription("Print a random number between 1 and 100.")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $sleepTime = random_int(1, 3);
        sleep($sleepTime);
        $output->writeln([random_int(1, 1000)]);

        return Command::SUCCESS;
    }
}

