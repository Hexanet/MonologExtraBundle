<?php

namespace Hexanet\Common\MonologExtraBundle\Logger\Request;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestLogger implements RequestLoggerInterface
{
    /**
     * LoggerInterface
     */
    protected $logger;

    /**
     * Construct
     *
     * @param LoggerInterface $logger Logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     */
    public function logRequest(Request $request)
    {
        $msg = sprintf(
            'Request "%s %s"',
            $request->getMethod(),
            $request->getRequestUri()
        );

        $this->logger->info($msg, $this->createContexts($request));
    }

    public function createContexts(Request $request)
    {
        $map = array(
            'request_method' => $request->getMethod(),
            'request_uri' => $request->getRequestUri(),
            'request_route' => $request->attributes->get('_route'),
            'request_host' => $request->getHost(),
            'request_port' => $request->getPort(),
            'request_scheme' => $request->getScheme(),
            'request_client_ip' => $request->getClientIp(),
            'request_content_type' => $request->getContentType(),
            'request_acceptable_content_types' => $request->getAcceptableContentTypes(),
            'request_etags' => $request->getETags(),
            'request_charsets' => $request->getCharsets(),
            'request_languages' => $request->getLanguages(),
            'request_locale' => $request->getLocale(),
            'request_auth_user' => $request->getUser(),
            'request_auth_has_password' => !is_null($request->getPassword()),
        );

        // Attributes from newer versions.
        if(method_exists($request, 'getEncodings')) {
            $map['request_encodings'] = $request->getEncodings();
        }

        if(method_exists($request, 'getClientIps')) {
            $map['request_client_ips'] = $request->getClientIps();
        }

        return $map;
    }

}
