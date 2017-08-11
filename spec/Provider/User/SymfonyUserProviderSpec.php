<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Provider\User;

use Hexanet\Common\MonologExtraBundle\Provider\User\SymfonyUserProvider;
use Hexanet\Common\MonologExtraBundle\Provider\User\UserProviderInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SymfonyUserProviderSpec extends ObjectBehavior
{
    function let(TokenStorageInterface $tokenStorage)
    {
        $this->beConstructedWith($tokenStorage);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SymfonyUserProvider::class);
    }

    function it_implements_user_provider_interface()
    {
        $this->shouldImplement(UserProviderInterface::class);
    }

    function it_returns_user()
    {
        $this->getUser()->shouldBeString();
    }
}