# HandsOnEkinoPhp Your Client

A PHP client library for interacting with the JSONPlaceholder API, with easy Symfony integration.

## Features

- Simple and clean API client for JSONPlaceholder
- Easy integration with Symfony applications
- Customizable HTTP client configuration
- Optional clock emoji header for fun

## Installation

Install the library via composer:

```bash
composer require hands-on-ekino-php/your-client
```

## Usage

### Basic usage with Symfony

1. Register the bundle in your `config/bundles.php`:

```php
return [
    // ...other bundles
    HandsOnEkinoPhp\YourClient\Bridge\Symfony\HandsOnEkinoPhpBundle::class => ['all' => true],
];
```

2. Configure the client in your `config/packages/hands_on.yaml`:

```yaml
hands_on_ekino_php:
    client:
        clock_header: true  # Set to false to disable the clock emoji header
        name: todos_client  # The name of your HTTP client service
```

3. Configure your HTTP client in `config/packages/framework.yaml`:

```yaml
framework:
    http_client:
        scoped_clients:
            todos_client:
                base_uri: 'https://jsonplaceholder.typicode.com'
```

4. Use the client in your actions or services:

```php
<?php

namespace App\Action;

use HandsOnEkinoPhp\YourClient\Client\TodosClient;
use Symfony\Component\HttpFoundation\JsonResponse;

class MyAction
{
    public function __invoke(TodosClient $todosClient): JsonResponse
    {
        // The client is automatically injected thanks to Symfony's autowiring
        return $todosClient->getTodos();
    }
}
```

## Development

### Running tests

```bash
vendor/bin/phpunit
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This library is open-sourced software licensed under the [MIT license](LICENSE).
