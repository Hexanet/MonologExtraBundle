<?php

namespace Hexanet\Common\MonologExtraBundle\Provider\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

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
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        $securityContext = $this->container->get('security.context');

        $user = self::USER_ANONYMOUS;
        if ($securityContext && $securityContext->getToken() !== null && $securityContext->getToken()->getUser() instanceof UserInterface) {
            $user = $securityContext->getToken()->getUser()->getUsername();
        }

        if (php_sapi_name() == "cli") {
            $user = self::USER_CLI;
        }

        return $user;
    }
}
