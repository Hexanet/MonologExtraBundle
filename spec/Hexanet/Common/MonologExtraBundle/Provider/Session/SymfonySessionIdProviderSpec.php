<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Provider\Session;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Hexanet\Common\MonologExtraBundle\Provider\Session\SymfonySessionIdProvider;

class SymfonySessionIdProviderSpec extends ObjectBehavior
{
    function let(SessionInterface $session)
    {
        $this->beConstructedWith(true, $session);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Hexanet\Common\MonologExtraBundle\Provider\Session\SymfonySessionIdProvider');
    }

    function it_implements_session_id_provider_interface()
    {
        $this->shouldImplement('Hexanet\Common\MonologExtraBundle\Provider\Session\SessionIdProviderInterface');
    }

    function it_starts_session(SessionInterface $session)
    {
        $session->isStarted()->willReturn(false);

        $session
            ->start()
            ->shouldBeCalled();

        $this->getSessionId()->shouldBeString();
    }

    function it_returns_session_id(SessionInterface $session)
    {
        $session->isStarted()->willReturn(true);

        $session
            ->getId()
            ->shouldBeCalled()
            ->willReturn('dfsdfgdg4sdfg4s5df4');

        $this->getSessionId()->shouldBeString();
    }

    function it_returns_specific_id_if_exception(SessionInterface $session)
    {
        $session
            ->start()
            ->willThrow("\RuntimeException");

        $this->getSessionId()->shouldReturn(SymfonySessionIdProvider::SESSION_ID_UNKNOWN);
    }
}
