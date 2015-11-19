<?php

namespace Hexanet\Common\MonologExtraBundle\Processor;

use Hexanet\Common\MonologExtraBundle\Provider\Session\SessionIdProviderInterface;

/**
 * Add session id to monolog messages
 */
class SessionIdProcessor
{
    /**
     * @var SessionIdProviderInterface
     */
    protected $sessionIdProvider;

    /**
     * @param SessionIdProviderInterface $sessionIdProvider
     */
    public function __construct(SessionIdProviderInterface $sessionIdProvider)
    {
        $this->sessionIdProvider = $sessionIdProvider;
    }

    /**
     * @param array $record
     *
     * @return array
     */
    public function processRecord(array $record)
    {
        $record['extra']['session_id'] = $this->sessionIdProvider->getSessionId();

        return $record;
    }
}