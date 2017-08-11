<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\Uid;

class UniqidProvider implements UidProviderInterface
{
    /**
     * @var string
     */
    protected $uid;

    public function __construct()
    {
        $this->uid = uniqid();
    }

    /**
     * @return string
     */
    public function getUid() : string
    {
        return $this->uid;
    }
}
