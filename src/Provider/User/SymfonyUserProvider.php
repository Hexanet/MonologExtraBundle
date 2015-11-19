<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SymfonyUserProvider implements UserProviderInterface
{
    /**
     * User for anonymous
     */
    const USER_ANONYMOUS = 'anonymous';

    /**
     * Value for user when we are in cli
     */
    CONST USER_CLI = 'cli';

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        $user = self::USER_ANONYMOUS;

        if (php_sapi_name() == "cli") {
            $user = self::USER_CLI;
        }

        if ($this->tokenStorage->getToken() !== null && $this->tokenStorage->getToken()->getUser() instanceof UserInterface) {
            $user = $this->tokenStorage->getToken()->getUser()->getUsername();
        }

        return $user;
    }
}
