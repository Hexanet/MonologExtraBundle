<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\Session;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SymfonySessionIdProvider implements SessionIdProviderInterface
{
    const SESSION_ID_UNKNOWN = 'unknown';

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var bool
     */
    protected $startSession;

    /**
     * @param SessionInterface $session
     * @param bool             $startSession
     */
    public function __construct(SessionInterface $session, bool $startSession = false)
    {
        $this->session = $session;
        $this->startSession = $startSession;
    }

    /**
     * @return string
     */
    public function getSessionId() : string
    {
        try {
            if ($this->startSession && !$this->session->isStarted()) {
                $this->session->start();
            }

            if ($this->session->isStarted()) {
                return $this->session->getId();
            }
        } catch (\RuntimeException $e) {
        }

        return self::SESSION_ID_UNKNOWN;
    }
}