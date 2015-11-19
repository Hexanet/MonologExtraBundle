<?php

namespace Hexanet\Common\MonologExtraBundle\Logger\Response;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ResponseLoggerInterface
{

    /**
     * @param Response $response
     * @param Request  $request
     */
    public function logResponse(Response $response, Request $request);

}