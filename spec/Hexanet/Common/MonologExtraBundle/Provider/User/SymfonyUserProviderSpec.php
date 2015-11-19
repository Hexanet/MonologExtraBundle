<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Provider\User;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\User;

class SymfonyUserProviderSpec extends ObjectBehavior
{
    function let(TokenStorageInterface $tokenStorage)
    {
        $this->beConstructedWith($tokenStorage, false);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Hexanet\Common\MonologExtraBundle\Provider\User\SymfonyUserProvider');
    }

    function it_implements_user_provider_interface()
    {
        $this->shouldImplement('Hexanet\Common\MonologExtraBundle\Provider\User\UserProviderInterface');
    }

    function it_returns_logged_user($tokenStorage, TokenInterface $token)
    {
        $user = new User('username', 'password');

        $tokenStorage->getToken()->willReturn($token);
        $token->getUser()->willReturn($user);

        $this->getUser()->shouldReturn('username');
    }

    function it_returns_cli_user($tokenStorage)
    {
        $this->beConstructedWith($tokenStorage, true);

        $this->getUser()->shouldReturn('cli');
    }
}
