<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Logger\Command;

use Hexanet\Common\MonologExtraBundle\Logger\Command\CommandLogger;
use Hexanet\Common\MonologExtraBundle\Logger\Command\CommandLoggerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandLoggerSpec extends ObjectBehavior
{
    function let(LoggerInterface $logger)
    {
        $this->beConstructedWith($logger);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CommandLogger::class);
    }

    function it_implements_command_logger_interface()
    {
        $this->shouldImplement(CommandLoggerInterface::class);
    }

    function it_logs_command(LoggerInterface $logger, Command $command, InputInterface $input, OutputInterface $output)
    {
        $logger
            ->info(Argument::type('string'), Argument::type('array'))
            ->shouldBeCalled();

        $this->logCommand($command, $input, $output);
    }
}
