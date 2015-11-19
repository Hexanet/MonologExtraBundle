<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Logger\Response;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

class ResponseLoggerSpec extends ObjectBehavior
{
    function let(LoggerInterface $logger)
    {
        $this->beConstructedWith($logger);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Hexanet\Common\MonologExtraBundle\Logger\Response\ResponseLogger');
    }

    function it_implements_response_logger_interface()
    {
        $this->shouldImplement('Hexanet\Common\MonologExtraBundle\Logger\Response\ResponseLoggerInterface');
    }

    function it_logs_request(LoggerInterface $logger, Response $response, Request $request, ParameterBag $parameterBag)
    {
        $logger
            ->info(Argument::type('string'), Argument::type('array'))
            ->shouldBeCalled();

        $request->attributes = $parameterBag;

        $this->logResponse($response, $request);
    }
}
