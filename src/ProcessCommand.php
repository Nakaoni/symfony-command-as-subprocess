<?php

declare(strict_types=1);

namespace Nakaoni\SymfonyCommandAsSubprocess;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

final class ProcessCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName("app:process")
            ->setDescription("Runs a command at defined number of times.")
            ->addArgument("times", InputArgument::REQUIRED, "number of times the command is run")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $times = (int) $input->getArgument("times");

        $processList = [];
        for ($i = 1; $i <= $times; $i++) {
            $process = new Process(["php", "app.php", "app:print"]);
            $output->writeln(["process P$i started"]);
            $process->start();

            $processList[$i] = $process;
        }

        $initialCount = count($processList);

        $completed = 0;
        while(true) {
            foreach($processList as $i => $process) {
                if ($process->isRunning()) {
                    continue;
                }

                $output->write(["P$i: "]);
                $output->write([$process->getOutput()]);

                $completed++;

                unset($processList[$i]);
            }

            if ($completed === $initialCount) {
                break;
            }
        }

        return Command::SUCCESS;
    }
}

