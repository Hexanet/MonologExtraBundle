<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Provider\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SymfonyUserProviderSpec extends ObjectBehavior
{
    function let(ContainerInterface $container)
    {
        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Hexanet\Common\MonologExtraBundle\Provider\User\SymfonyUserProvider');
    }

    function it_implements_user_provider_interface()
    {
        $this->shouldImplement('Hexanet\Common\MonologExtraBundle\Provider\User\UserProviderInterface');
    }

    function it_returns_user()
    {
        $this->getUser()->shouldBeString();
    }
}