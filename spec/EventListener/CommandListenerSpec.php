<?php

namespace spec\Hexanet\Common\MonologExtraBundle\EventListener;

use Hexanet\Common\MonologExtraBundle\EventListener\CommandListener;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Hexanet\Common\MonologExtraBundle\Logger\Command\CommandLoggerInterface;

class CommandListenerSpec extends ObjectBehavior
{
    function let(CommandLoggerInterface $commandLogger)
    {
        $this->beConstructedWith($commandLogger);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CommandListener::class);
    }
}
