# Hands-on-ekino-php your-client

# Purpose

This library provides a PHP client to interact with jsonplaceholder
shipped with a Symfony bundle to easy integrate it in a Symfony project.

# Installation

## Step 1: add the dependency

```bash
$ composer require hands-on-ekino-php/your-client
```

## Step 2: register the bundle

```php
<?php

// config/bundles.php

return [
    // ...
    HandsOnEkinoPhp\YourClient\Bridge\Symfony\HandsOnEkinoPhpBundle::class => ['all' => true],
    // ...
];
```

## Step 3: create the client

```yaml
# config/packages/framework.yaml

framework:
    # ...

  http_client:
      scoped_clients:
          todos_client:
              base_uri: 'https://jsonplaceholder.typicode.com'
              headers:
                Content-type: 'application/json'

  # ...
```

## Step 4: configure the bundle

```yaml
# config/packages/ekino_vw_http_clients.yaml

hands_on_ekino_php:
      client:
          name: 'todos_client' # use the same name your configured as client in framework.yaml
          clock_header: true # default false
```

# Usage

## Using Symfony

Inject your client, and enjoy !

```php
<?php

use HandsOnEkinoPhp\YourClient\Client\TodosClient;

class MyService
{
    private $clientApi;

    public function __construct(private TodosClient $todosClient) {
    }

    public function doSmth()
    {
        $this->todosClient->getTodos();
    }
}
```
