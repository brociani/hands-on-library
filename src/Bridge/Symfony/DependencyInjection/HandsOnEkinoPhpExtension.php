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
    /**
     * @param mixed[] $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->configureClientDefinition($config['client']['name'], $config['client']['clock_header'], $container);
    }

    private function configureClientDefinition(string $clientUrl, bool $clockHeader, ContainerBuilder $container): void
    {
        $definition = new Definition(TodosClient::class, [new Reference($clientUrl), $clockHeader]);
        $container->setDefinition(TodosClient::class, $definition);
    }
}
