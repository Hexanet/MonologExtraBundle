<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Processor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AdditionsProcessorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Hexanet\Common\MonologExtraBundle\Processor\AdditionsProcessor');
    }

    function it_adds_nothing_to_record_by_default()
    {
        $this->processRecord([])->shouldReturn([]);
    }

    function it_adds_entries_to_record()
    {
        $this->beConstructedWith(['type' => 'symfony']);

        $this->processRecord(['message' => 'log'])->shouldReturn([
            'message' => 'log',
            'extra' => [
                'type' => 'symfony'
            ]
        ]);
    }
}
