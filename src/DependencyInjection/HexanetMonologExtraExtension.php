<?php

namespace Hexanet\Common\MonologExtraBundle\DependencyInjection;

use Hexanet\Common\MonologExtraBundle\EventListener\CommandListener;
use Hexanet\Common\MonologExtraBundle\EventListener\ConsoleExceptionListener;
use Hexanet\Common\MonologExtraBundle\EventListener\RequestResponseListener;
use Hexanet\Common\MonologExtraBundle\EventListener\UidResponseListener;
use Hexanet\Common\MonologExtraBundle\Processor\AdditionsProcessor;
use Hexanet\Common\MonologExtraBundle\Processor\SessionIdProcessor;
use Hexanet\Common\MonologExtraBundle\Processor\UidProcessor;
use Hexanet\Common\MonologExtraBundle\Processor\UserProcessor;
use Hexanet\Common\MonologExtraBundle\Provider\Session\SessionIdProviderInterface;
use Hexanet\Common\MonologExtraBundle\Provider\Uid\UidProviderInterface;
use Hexanet\Common\MonologExtraBundle\Provider\User\UserProviderInterface;
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

        $container->setAlias(UidProviderInterface::class, $config['provider']['uid']);
        $container->setAlias(SessionIdProviderInterface::class, $config['provider']['session_id']);
        $container->setAlias(UserProviderInterface::class, $config['provider']['user']);

        $this->addAdditions($container, $config);
        $this->addProcessors($container, $config);
        $this->addConsoleExceptionListener($container, $config);
        $this->addRequestResponseListener($container, $config);
        $this->addCommandListener($container, $config);
        $this->addUidToResponseListener($container, $config);
    }

    protected function addAdditions(ContainerBuilder $container, array $config)
    {
        $definition = $container->getDefinition(AdditionsProcessor::class);

        $definition
            ->addTag('monolog.processor', ['method' => 'processRecord'])
            ->addArgument($config['processor']['additions']);
    }

    protected function addProcessors(ContainerBuilder $container, array $config) {
        if ($config['processor']['user']) {
            $definition = $container->getDefinition(UserProcessor::class);
            $definition->addTag('monolog.processor', ['method' => 'processRecord']);
        } else {
            $container->removeDefinition(UserProcessor::class);
        }

        if ($config['processor']['uid']) {
            $definition = $container->getDefinition(UidProcessor::class);
            $definition->addTag('monolog.processor', ['method' => 'processRecord']);
        } else {
            $container->removeDefinition(UidProcessor::class);
        }

        if ($config['processor']['session_id']) {
            $definition = $container->getDefinition(SessionIdProcessor::class);
            $definition->addTag('monolog.processor', ['method' => 'processRecord']);
        } else {
            $container->removeDefinition(SessionIdProcessor::class);
        }
    }

    protected function addConsoleExceptionListener(ContainerBuilder $container, array $config)
    {
        if (!$config['logger']['on_console_exception']) {
            $container->removeDefinition(ConsoleExceptionListener::class);

            return;
        }

        $definition = $container->getDefinition(ConsoleExceptionListener::class);
        $definition->addTag('kernel.event_listener', ['event' => ConsoleEvents::ERROR, 'method' => 'onConsoleException']);
    }

    protected function addRequestResponseListener(ContainerBuilder $container, array $config)
    {
        if (!$config['logger']['on_request'] && !$config['logger']['on_response']) {
            $container->removeDefinition(RequestResponseListener::class);

            return;
        }

        $definition = $container->getDefinition(RequestResponseListener::class);

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
            $container->removeDefinition(CommandListener::class);

            return;
        }

        $definition = $container->getDefinition(CommandListener::class);
        $definition->addTag('kernel.event_listener', ['event' => ConsoleEvents::COMMAND, 'method' => 'onCommandResponse']);
    }

    protected function addUidToResponseListener(ContainerBuilder $container, array $config)
    {
        if (!$config['logger']['add_uid_to_response']) {
            $container->removeDefinition(UidResponseListener::class);

            return;
        }

        $definition = $container->getDefinition(UidResponseListener::class);
        $definition->addTag('kernel.event_listener', ['event' => KernelEvents::RESPONSE, 'method' => 'onKernelResponse']);
    }
}
