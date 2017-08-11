<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\User;

interface UserProviderInterface
{
    /**
     * @return string;
     */
    public function getUser() : string;
}