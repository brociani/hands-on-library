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

namespace Tests\Ekino\VwHttpClients\Bridge\Symfony\DependencyInjection;

use HandsOnEkinoPhp\YourClient\Bridge\Symfony\DependencyInjection\HandsOnEkinoPhpExtension;
use HandsOnEkinoPhp\YourClient\Client\TodosClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class HandsOnEkinoPhpExtensionTest extends TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var HandsOnEkinoPhpExtension
     */
    private $extension;

    protected function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $this->extension = new HandsOnEkinoPhpExtension();
    }

    public function testFullConfig(): void
    {
        $this->extension->load($this->getFullConfig(), $this->container);

        $this->assertHasDefinition(TodosClient::class);
    }

    /**
     * @return mixed[]
     */
    private function getFullConfig(): array
    {
        return [
            'my_client' => [
                'client' => [
                    'name' => 'client_name',
                    'clock_header' => true,
                ],
            ],
        ];
    }

    private function assertHasDefinition(string $id): void
    {
        $this->assertTrue($this->container->hasDefinition($id));
    }
}
