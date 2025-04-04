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

namespace HandsOnEkinoPhp\YourClient\Tests\Bridge\Symfony\DependencyInjection;

use HandsOnEkinoPhp\YourClient\Bridge\Symfony\DependencyInjection\HandsOnEkinoPhpExtension;
use HandsOnEkinoPhp\YourClient\Client\TodosClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class HandsOnEkinoPhpExtensionTest extends TestCase
{
    public function testLoadConfigurationWithDefaultValues(): void
    {
        $container = new ContainerBuilder();
        $extension = new HandsOnEkinoPhpExtension();
        
        $extension->load([
            'hands_on_ekino_php' => [
                'client' => [
                    'clock_header' => true,
                    'name' => 'http_client_test',
                ],
            ],
        ], $container);
        
        // Verify parameters are set correctly
        $this->assertTrue($container->hasParameter('hands_on_ekino_php.your_client.clock_header'));
        $this->assertEquals(true, $container->getParameter('hands_on_ekino_php.your_client.clock_header'));
        
        $this->assertTrue($container->hasParameter('hands_on_ekino_php.your_client.name'));
        $this->assertEquals('http_client_test', $container->getParameter('hands_on_ekino_php.your_client.name'));
        
        // Verify that the TodosClient service is registered
        $this->assertTrue($container->hasDefinition(TodosClient::class));
        
        // Get the TodosClient definition
        $definition = $container->getDefinition(TodosClient::class);
        $arguments = $definition->getArguments();
        
        // Verify the arguments
        $this->assertCount(2, $arguments);
        
        // First argument should be a Reference to the HTTP client
        $this->assertInstanceOf(Reference::class, $arguments['$client']);
        $this->assertEquals('http_client_test', (string) $arguments['$client']);
        
        // Second argument should be the clock_header parameter
        $this->assertTrue($arguments['$clockHeader']);
    }
    
    public function testLoadConfigurationWithClockHeaderDisabled(): void
    {
        $container = new ContainerBuilder();
        $extension = new HandsOnEkinoPhpExtension();
        
        $extension->load([
            'hands_on_ekino_php' => [
                'client' => [
                    'clock_header' => false,
                    'name' => 'http_client_test',
                ],
            ],
        ], $container);
        
        // Verify clock_header parameter is set to false
        $this->assertFalse($container->getParameter('hands_on_ekino_php.your_client.clock_header'));
        
        // Get the TodosClient definition
        $definition = $container->getDefinition(TodosClient::class);
        $arguments = $definition->getArguments();
        
        // Verify the clock_header argument is false
        $this->assertFalse($arguments['$clockHeader']);
    }
}
