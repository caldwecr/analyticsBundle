<?php

namespace Cympel\Bundle\AnalyticsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cympel_analytics');

        $rootNode
            ->children()
                ->scalarNode('entity_manager')
                    ->info('This optional configuration parameter allows you to specify which entity manager should be used by the bundle for ORM - this is useful in particular if the database you use for analytics tables is different than your default')
                    ->defaultValue('')
                ->end()
                ->scalarNode('test_entity_manager')
                    ->info('This optional parameter allows you to specify a unique entity manager for use in running the tests in this bundle')
                    ->defaultValue('')
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
