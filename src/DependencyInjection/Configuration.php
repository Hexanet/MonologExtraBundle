<?php

namespace Hexanet\Common\MonologExtraBundle\DependencyInjection;

use Hexanet\Common\MonologExtraBundle\Provider\Session\SymfonySessionIdProvider;
use Hexanet\Common\MonologExtraBundle\Provider\Uid\UniqidProvider;
use Hexanet\Common\MonologExtraBundle\Provider\User\SymfonyUserProvider;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('hexanet_monolog_extra');

        $rootNode
            ->children()
                ->booleanNode('session_start')
                    ->defaultFalse()
                    ->info('If the session should be started, so the session_id will always be available.')
                ->end()
                ->arrayNode('processor')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('user')->defaultFalse()->end()
                        ->scalarNode('session_id')
                            ->info("Adds session id into records")
                            ->defaultFalse()
                        ->end()
                        ->scalarNode('uid')
                            ->info("Adds UID into records")
                            ->defaultFalse()
                        ->end()
                        ->arrayNode('additions')
                            ->info('A list of "key: value" entries that will be set in the [extra] section of each log message (Overwrites existing keys!).')
                            ->useAttributeAsKey('key')
                            ->normalizeKeys(false)
                            ->prototype('scalar')
                                ->info('Value for the key.')
                                ->isRequired()
                                ->example('value')
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('provider')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('session_id')
                            ->info("Provider for session id")
                            ->defaultValue(SymfonySessionIdProvider::class)
                        ->end()
                        ->scalarNode('uid')
                            ->info("Provider for uid")
                            ->defaultValue(UniqidProvider::class)
                        ->end()
                        ->scalarNode('user')
                            ->info("Provider for user")
                            ->defaultValue(SymfonyUserProvider::class)
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('logger')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('on_request')->defaultFalse()->end()
                        ->scalarNode('on_response')->defaultFalse()->end()
                        ->scalarNode('on_command')->defaultFalse()->end()
                        ->scalarNode('on_console_exception')->defaultTrue()->end()
                        ->scalarNode('add_uid_to_response')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
