<?php

namespace spec\Hexanet\Common\MonologExtraBundle\Processor;

use Hexanet\Common\MonologExtraBundle\Processor\AdditionsProcessor;
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
        $this->shouldHaveType(AdditionsProcessor::class);
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
