<?php

namespace Hexanet\Common\MonologExtraBundle\EventListener;

use Hexanet\Common\MonologExtraBundle\Logger\Command\CommandLoggerInterface;
use Symfony\Component\Console\Event\ConsoleCommandEvent;

/**
 * CommandListener
 */
class CommandListener
{
    /**
     * @var CommandLoggerInterface
     */
    protected $commandLogger;

    /**
     * @param CommandLoggerInterface $commandLogger
     */
    public function __construct(CommandLoggerInterface $commandLogger)
    {
        $this->commandLogger = $commandLogger;
    }

    /**
     * @param ConsoleCommandEvent $event
     */
    public function onCommandResponse(ConsoleCommandEvent $event) : void
    {
        $this->commandLogger->logCommand($event->getCommand(), $event->getInput(), $event->getOutput());
    }

}
