<?php

namespace Hexanet\Common\MonologExtraBundle\Gelf;

use Gelf\Publisher as BasePublisher;
use Gelf\MessageInterface;
use Gelf\Transport\TransportInterface;

class Publisher extends BasePublisher
{
    /**
     * @inheritdoc
     */
    public function publish(MessageInterface $message)
    {
        set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
            // error was suppressed with the @-operator
            if (0 === error_reporting()) {
                return false;
            }

            throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
        });

        try {
            parent::publish($message);
        }
        catch (\ErrorException $e) {
            error_log('Gelf host is unreachable');
        }
        catch (\RuntimeException $e) {
            error_log('Gelf Publisher : ' . $e->getMessage());
        }

        restore_error_handler();
    }

}
