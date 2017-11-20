<?php

namespace Hexanet\Common\MonologExtraBundle\Logger\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface CommandLoggerInterface
{
    /**
     * @param Command $command
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function logCommand(Command $command, InputInterface $input, OutputInterface $output) : void;
}
