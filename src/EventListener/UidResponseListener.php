<?php

namespace Hexanet\Common\MonologExtraBundle\EventListener;

use Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class UidResponseListener
{
    /**
     * @var UidProviderInterface
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
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event) : void
    {
        $event->getResponse()->headers->set('X-UID', $this->uidProvider->getUid());
    }

}