<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Provider\User;

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