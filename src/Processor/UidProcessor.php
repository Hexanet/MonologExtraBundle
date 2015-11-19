<?php

namespace Hexanet\Common\MonologExtraBundle\Processor;

use Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface;

/**
 * Add uid to records
 */
class UidProcessor
{
    /**
     * @var \Hexanet\Common\LogBundle\Provider\Uid\UidProviderInterface
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
    public function processRecord(array $record)
    {
        $record['extra']['uid'] = $this->uidProvider->getUid();

        return $record;
    }
}