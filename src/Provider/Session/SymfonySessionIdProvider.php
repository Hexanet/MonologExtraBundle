<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\Session;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SymfonySessionIdProvider implements SessionIdProviderInterface
{
    const SESSION_ID_UNKNOWN = 'unknown';

    /**
     * @var bool
     */
    protected $startSession;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * Construct
     *
     * @param bool             $startSession
     * @param SessionInterface $session
     */
    public function __construct(bool $startSession = false, SessionInterface $session)
    {
        $this->startSession = $startSession;
        $this->session = $session;
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