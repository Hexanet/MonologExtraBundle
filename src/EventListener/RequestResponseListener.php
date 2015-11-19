<?php

namespace Hexanet\Common\MonologExtraBundle\EventListener;

use Hexanet\Common\MonologExtraBundle\Logger\Request\RequestLoggerInterface;
use Hexanet\Common\MonologExtraBundle\Logger\Response\ResponseLoggerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * RequestListener
 */
class RequestResponseListener
{
    /**
     * @var RequestLoggerInterface
     */
    protected $requestLogger;


    /**
     * @var ResponseLoggerInterface
     */
    protected $responseLogger;

    /**
     * @param RequestLoggerInterface  $requestLogger
     * @param ResponseLoggerInterface $responseLogger
     */
    public function __construct(RequestLoggerInterface $requestLogger, ResponseLoggerInterface $responseLogger)
    {
        $this->requestLogger = $requestLogger;
        $this->responseLogger = $responseLogger;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onRequest(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            return;
        }

        $this->requestLogger->logRequest($event->getRequest());
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onResponse(FilterResponseEvent $event)
    {
        $this->responseLogger->logResponse($event->getResponse(), $event->getRequest());
    }

}