<?php

namespace Hexanet\Common\MonologExtraBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SecurityContextPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has('security.token_storage')) {
            $argument = new Reference('security.token_storage');
        } elseif ($container->has('security.context')) {
            $argument = new Reference('security.context');
        } else {
            return; // SecurityBundle is not configured
        }

        $definition = $container->findDefinition('hexanet_monolog_extra.logger.provider.user.symfony');
        $definition->addArgument($argument);
    }
}