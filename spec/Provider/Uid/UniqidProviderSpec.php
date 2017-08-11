<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Provider\Uid;

use Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface;
use Hexanet\Common\MonologExtraBundle\Provider\Uid\UniqidProvider;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UniqidProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UniqidProvider::class);
    }

    function it_implements_request_id_provider_interface()
    {
        $this->shouldImplement(UidProviderInterface::class);
    }

    function it_returns_uid()
    {
        $this->getUid()->shouldBeString();
    }

    function it_returns_same_uid_everytime()
    {
        $id = $this->getUid();
        $this->getUid()->shouldReturn($id);
    }
}
