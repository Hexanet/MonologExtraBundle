<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Provider\Uid;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApacheUniqueIdProviderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Hexanet\Common\MonologExtraBundle\Provider\Uid\ApacheUniqueIdProvider');
    }

    function it_implements_request_id_provider_interface()
    {
        $this->shouldImplement('Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface');
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
