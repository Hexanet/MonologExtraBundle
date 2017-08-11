<?php

namespace Hexanet\Common\MonologExtraBundle\Logger\Request;

use Symfony\Component\HttpFoundation\Request;

interface RequestLoggerInterface
{
    /**
     * @param Request $request
     */
    public function logRequest(Request $request) : void;

}