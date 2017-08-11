<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\User;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @var TokenStorageInterface|null
     */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface|null $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage = null)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return string
     */
    public function getUser() : string
    {
        $user = self::USER_ANONYMOUS;

        if (null !== $this->tokenStorage) {
            $token = $this->tokenStorage->getToken();
            if (null !== $token && $token->getUser() instanceof UserInterface) {
                $user = $token->getUser()->getUsername();
            }
        }

        if (php_sapi_name() === 'cli') {
            $user = self::USER_CLI;
        }

        return $user;
    }
}
