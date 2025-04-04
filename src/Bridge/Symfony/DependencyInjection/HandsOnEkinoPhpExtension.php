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

use HandsOnEkinoPhp\YourClient\Client\TodosClient;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class HandsOnEkinoPhpExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $client = new Reference($config['client']);
        $addClock = $config['add_clock'];

        $this->configureClientDefinition($client, $addClock, $container);
    }

    private function configureClientDefinition(Reference $client, bool $addClock, ContainerBuilder $container): void
    {
        $definition = new Definition(TodosClient::class, [
            $client,
            $addClock,
        ]);

        $container->setDefinition('todos_client', $definition);
        // Here an Hint : We need to set the definition of our class using the ContainerBuilder
    }
}
