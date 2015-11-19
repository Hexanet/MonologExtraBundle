<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\Uid;

class ApacheUniqueIdProvider implements UidProviderInterface
{
    /**
     * @var string
     */
    protected $uid;

    public function __construct(array $serverData = null)
    {
        $uid = uniqid();

        if (!is_array($serverData)) {
            $serverData = &$_SERVER;
        }

        if (isset($serverData['UNIQUE_ID'])) {
            $uid = $serverData['UNIQUE_ID'];
        }
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }
}
