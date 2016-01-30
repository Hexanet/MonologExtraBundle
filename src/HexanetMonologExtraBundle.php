<?php

namespace Hexanet\Common\MonologExtraBundle;

use Hexanet\Common\MonologExtraBundle\DependencyInjection\Compiler\SecurityContextPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class HexanetMonologExtraBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SecurityContextPass());
    }
}
