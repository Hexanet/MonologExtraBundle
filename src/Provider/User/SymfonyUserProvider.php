<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\User;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;
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

    private $tokenStorage;

    /**
     * @param ContainerInterface|TokenStorageInterface|null $tokenStorage
     */
    public function __construct($tokenStorage = null)
    {
        // BC layer for Symfony 2.5 and older
        if ($tokenStorage instanceof ContainerInterface) {
            $this->tokenStorage = $tokenStorage;

            return;
        }

        if (null !== $tokenStorage && !$tokenStorage instanceof TokenStorageInterface) {
            throw new \InvalidArgumentException(sprintf('The first argument of the %s constructor should be a Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface or a Symfony\Component\DependencyInjection\ContainerInterface or null.', __CLASS__));
        }

        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        $user = self::USER_ANONYMOUS;

        $tokenStorage = $this->getTokenStorage();
        if (null !== $tokenStorage) {
            $token = $tokenStorage->getToken();
            if (null !== $token && $token->getUser() instanceof UserInterface) {
                $user = $token->getUser()->getUsername();
            }
        }

        if (php_sapi_name() == "cli") {
            $user = self::USER_CLI;
        }

        return $user;
    }

    /**
     * @return SecurityContextInterface|TokenStorageInterface
     */
    public function getTokenStorage()
    {
        // BC layer for Symfony 2.5 and older
        if ($this->tokenStorage instanceof ContainerInterface) {
            return $this->tokenStorage->get('security.context');
        }

        return $this->tokenStorage;
    }
}
