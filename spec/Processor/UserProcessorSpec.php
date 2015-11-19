<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Processor;

use Hexanet\Common\MonologExtraBundle\Provider\User\UserProviderInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserProcessorSpec extends ObjectBehavior
{
    function let(UserProviderInterface $userProvider)
    {
        $this->beConstructedWith($userProvider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Hexanet\Common\MonologExtraBundle\Processor\UserProcessor');
    }

    function it_adds_user_to_record(UserProviderInterface $userProvider)
    {
        $userProvider
            ->getUser()
            ->willReturn('boris');

        $this->processRecord(['message' => 'test log'])->shouldReturn([
            'message' => 'test log',
            'extra' => [
                'user' => 'boris'
            ]
        ]);
    }
}
