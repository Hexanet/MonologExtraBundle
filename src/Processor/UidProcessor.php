<?php

namespace Hexanet\Common\MonologExtraBundle\Processor;

use Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface;

class UidProcessor
{
    /**
     * @var UidProviderInterface
     */
    protected $uidProvider;

    /**
     * @param UidProviderInterface $uidProvider
     */
    public function __construct(UidProviderInterface $uidProvider)
    {
        $this->uidProvider = $uidProvider;
    }

    /**
     * Process a record
     *
     * @param array $record
     *
     * @return array
     */
    public function processRecord(array $record) : array
    {
        $record['extra']['uid'] = $this->uidProvider->getUid();

        return $record;
    }
}