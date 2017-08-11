<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Processor;

use Hexanet\Common\MonologExtraBundle\Processor\UidProcessor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface;

class UidProcessorSpec extends ObjectBehavior
{
    function let(UidProviderInterface $uidProvider)
    {
        $this->beConstructedWith($uidProvider);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UidProcessor::class);
    }

    function it_adds_uniq_request_id_to_record(UidProviderInterface $uidProvider)
    {
        $uidProvider
            ->getUid()
            ->willReturn('qs5df4qsd4fqs4df5qs4df8s5d');

        $this->processRecord(['message' => 'test log'])->shouldReturn([
            'message' => 'test log',
            'extra' => [
                'uid' => 'qs5df4qsd4fqs4df5qs4df8s5d'
            ]
        ]);
    }
}
