<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\Uid;

interface UidProviderInterface
{
    /**
     * @return mixed
     */
    public function getUid();
}