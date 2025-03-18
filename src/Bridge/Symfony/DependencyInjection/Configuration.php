<?php

declare(strict_types=1);

/*
 * This file is part of the hands-on-ekino-php/your-client project.
 *
 * (c) Ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace HandsOnEkinoPhp\YourClient\Bridge\Symfony\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('my_client');
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        // @phpstan-ignore-next-line
        $rootNode
            ->children()
                ->arrayNode('client')->isRequired()
                    ->children()
                        ->scalarNode('name')->isRequired()->cannotBeEmpty()->end()
                        ->booleanNode('clock_header')->defaultValue(false)->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
