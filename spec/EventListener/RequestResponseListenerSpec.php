<?php

namespace spec\Hexanet\Common\MonologExtraBundle\EventListener;

use Hexanet\Common\MonologExtraBundle\EventListener\RequestResponseListener;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Hexanet\Common\MonologExtraBundle\Logger\Request\RequestLoggerInterface;
use Hexanet\Common\MonologExtraBundle\Logger\Response\ResponseLoggerInterface;

class RequestResponseListenerSpec extends ObjectBehavior
{
    function let(RequestLoggerInterface $requestLogger, ResponseLoggerInterface $responseLogger)
    {
        $this->beConstructedWith($requestLogger, $responseLogger);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RequestResponseListener::class);
    }
}
