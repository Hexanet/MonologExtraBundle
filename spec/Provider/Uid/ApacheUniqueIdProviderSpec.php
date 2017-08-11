<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Provider\Uid;

use Hexanet\Common\MonologExtraBundle\Provider\Uid\ApacheUniqueIdProvider;
use Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApacheUniqueIdProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ApacheUniqueIdProvider::class);
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

    function it_returns_uid_from_server_data()
    {
        $this->beConstructedWith(['UNIQUE_ID' => 'sqdfjhqsodukfhqsdui']);
        $this->getUid()->shouldReturn('sqdfjhqsodukfhqsdui');
    }
}
