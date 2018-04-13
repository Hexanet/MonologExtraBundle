<?php

namespace Hexanet\Common\MonologExtraBundle\Processor;

class AdditionsProcessor
{
    /**
     * @var array
     */
    protected $entries;

    /**
     * @param array $entries
     */
    public function __construct(array $entries = [])
    {
        $this->entries = $entries;
    }

    /**
     * @param array $record
     *
     * @return array
     */
    public function processRecord(array $record) : array
    {
        foreach ($this->entries as $key => $value) {
            $record['extra'][$key] = $value;
        }

        return $record;
    }
}