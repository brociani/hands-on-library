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
        
        $container->setParameter('hands_on_ekino_php.your_client.clock_header', $config['client']['clock_header']);
        $container->setParameter('hands_on_ekino_php.your_client.name', $config['client']['name']);

        $this->configureClientDefinition($container);
    }

    private function configureClientDefinition(ContainerBuilder $container): void
    {
        $httpClientName = $container->getParameter('hands_on_ekino_php.your_client.name');
        
        $definition = new Definition(TodosClient::class, [
            '$client'      => new Reference($httpClientName),
            '$clockHeader' => $container->getParameter('hands_on_ekino_php.your_client.clock_header'),
        ]);

        $container->setDefinition(TodosClient::class, $definition);
    }
}
