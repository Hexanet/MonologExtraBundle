<?php

namespace Hexanet\Common\MonologExtraBundle\Processor;

class AdditionsProcessor
{
    protected $entries;

    public function __construct(array $entries)
    {
        $this->entries = $entries;
    }

    public function processRecord(array $record)
    {
        foreach ($this->entries as $key => $value) {
            $record['extra'][$key] = $value;
        }

        return $record;
    }
}