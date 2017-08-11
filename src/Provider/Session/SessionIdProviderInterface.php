<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\Session;

interface SessionIdProviderInterface
{
    /**
     * @return string
     */
    public function getSessionId() : string;
}