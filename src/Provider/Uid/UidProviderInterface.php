<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\Uid;

interface UidProviderInterface
{
    /**
     * @return string
     */
    public function getUid() : string;
}