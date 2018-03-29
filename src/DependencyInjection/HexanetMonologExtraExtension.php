<?php

namespace Hexanet\Common\MonologExtraBundle\DependencyInjection;

use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\KernelEvents;

class HexanetMonologExtraExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('hexanet_monolog_extra.session_start', $config['session_start']);

        $container->setAlias('hexanet_monolog_extra.logger.provider.uid', $config['provider']['uid']);
        $container->setAlias('hexanet_monolog_extra.logger.provider.session', $config['provider']['session_id']);
        $container->setAlias('hexanet_monolog_extra.logger.provider.user', $config['provider']['user']);

        $this->addAdditions($container, $config);
        $this->addProcessors($container, $config);
        $this->addConsoleExceptionListener($container, $config);
        $this->addRequestResponseListener($container, $config);
        $this->addCommandListener($container, $config);
        $this->addUidToResponseListener($container, $config);
    }

    protected function addAdditions(ContainerBuilder $container, array $config)
    {
        $definition = $container->getDefinition('hexanet_monolog_extra.logger.processor.additions');

        $definition
            ->addTag('monolog.processor', ['method' => 'processRecord'])
            ->replaceArgument(0, $config['processor']['additions']);
    }

    protected function addProcessors(ContainerBuilder $container, array $config) {
        if ($config['processor']['user']) {
            $definition = $container->getDefinition('hexanet_monolog_extra.logger.processor.username');
            $definition->addTag('monolog.processor', ['method' => 'processRecord']);
        } else {
            $container->removeDefinition('hexanet_monolog_extra.logger.processor.username');
        }

        if ($config['processor']['uid']) {
            $definition = $container->getDefinition('hexanet_monolog_extra.logger.processor.uid');
            $definition->addTag('monolog.processor', ['method' => 'processRecord']);
        } else {
            $container->removeDefinition('hexanet_monolog_extra.logger.processor.uid');
        }

        if ($config['processor']['session_id']) {
            $definition = $container->getDefinition('hexanet_monolog_extra.logger.processor.session_id');
            $definition->addTag('monolog.processor', ['method' => 'processRecord']);
        } else {
            $container->removeDefinition('hexanet_monolog_extra.logger.processor.session_id');
        }
    }

    protected function addConsoleExceptionListener(ContainerBuilder $container, array $config)
    {
        if (!$config['logger']['on_console_exception']) {
            $container->removeDefinition('hexanet_monolog_extra.listener.console_exception');

            return;
        }

        $event = class_exists('Symfony\Component\Console\Event\ConsoleErrorEvent') ? ConsoleEvents::ERROR : ConsoleEvents::EXCEPTION;

        $definition = $container->getDefinition('hexanet_monolog_extra.listener.console_exception');
        $definition->addTag('kernel.event_listener', ['event' => $event, 'method' => 'onConsoleException']);
    }

    protected function addRequestResponseListener(ContainerBuilder $container, array $config)
    {
        if (!$config['logger']['on_request'] && !$config['logger']['on_response']) {
            $container->removeDefinition('hexanet_monolog_extra.listener.request_response');

            return;
        }

        $definition = $container->getDefinition('hexanet_monolog_extra.listener.request_response');

        if ($config['logger']['on_request']) {
            $definition->addTag('kernel.event_listener', ['event' => KernelEvents::REQUEST, 'method' => 'onRequest']);
        }

        if ($config['logger']['on_response']) {
            $definition->addTag('kernel.event_listener', ['event' => KernelEvents::RESPONSE, 'method' => 'onResponse']);
        }
    }

    protected function addCommandListener(ContainerBuilder $container, array $config)
    {
        if (!$config['logger']['on_command']) {
            $container->removeDefinition('hexanet_monolog_extra.listener.command');

            return;
        }

        $definition = $container->getDefinition('hexanet_monolog_extra.listener.command');
        $definition->addTag('kernel.event_listener', ['event' => ConsoleEvents::COMMAND, 'method' => 'onCommandResponse']);
    }

    protected function addUidToResponseListener(ContainerBuilder $container, array $config)
    {
        if (!$config['logger']['add_uid_to_response']) {
            $container->removeDefinition('hexanet_monolog_extra.listener.uid_to_response');

            return;
        }

        $definition = $container->getDefinition('hexanet_monolog_extra.listener.uid_to_response');
        $definition->addTag('kernel.event_listener', ['event' => KernelEvents::RESPONSE, 'method' => 'onKernelResponse']);
    }
}
