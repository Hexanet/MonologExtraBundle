<?php

namespace Hexanet\Common\MonologExtraBundle\EventListener;

use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;
use Psr\Log\LoggerInterface;

class ConsoleExceptionListener
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ConsoleErrorEvent $event
     */
    public function onConsoleException(ConsoleErrorEvent $event) : void
    {
        if (!$event instanceof ConsoleExceptionEvent && !$event instanceof ConsoleErrorEvent) {
            throw new \InvalidArgumentException('Event must be an instance of ConsoleExceptionEvent or ConsoleErrorEvent');
        }

        $command = $event->getCommand();
        $exception = $event instanceof ConsoleErrorEvent ? $event->getError() : $event->getException();

        $message = sprintf(
            '%s: %s (uncaught exception) at %s line %s while running console command `%s`',
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $command->getName()
        );

        $this->logger->error($message, [
            'exception' => $exception
        ]);
    }
}