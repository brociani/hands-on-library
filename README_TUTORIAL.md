## Tutorial : 

Thanks for participating in this Hands On.

We will see how to create a Library in php

First Fork this project and integrate it into https://gitlab.ekino.com/clement.luciani/hands-on-php-project using composer through VCS


there is two useful make command 
* ```make infra-up``` to launch the docker
* ```make infra-shell``` to connect to your container.

Take a look at the composer.json, i already generated it using ``composer init``
but it has important definitions : 

* the name of our library : ``"name": "hands-on-ekino-php/your-client",``
* the type : ``"type": "library",``
* and the License : ``"license": "MIT",``

we already have our only dependency :

```"symfony/http-client": "^7.2"```

and our dev dependencies :
```
"friendsofphp/php-cs-fixer": "^3",
"symfony/config": "^7.2",
"symfony/dependency-injection": "^7.2",
"symfony/http-kernel": "^7.2",
"phpunit/phpunit": "^12.0",
"phpstan/phpstan-phpunit": "^2.0"
"phpstan/phpstan": "^2.1",
```
To make sure when someone submit a Pull Request, it respect our coding style and doesn't breaks anything

Now let's dive into the library creation :

## How this library works
we have a client http that make a call, and add some headers.
One header by default and another one optional.

The goal of this Library is to use a symfony/http-client service defined it will be injected into our library through the configuration file

You will define our configuration :
* A node ``client`` with two params
* The http-client defined through the key `name`
* A boolean for the optional header named `clock_header`

take a look at the configuration file in :
``HandsOnEkinoPhp\YourClient\Bridge\Symfony\DependencyInjection\Configuration.php``

and create the loading system in the file :
``HandsOnEkinoPhp\YourClient\Bridge\Symfony\DependencyInjection\HandsOnEkinoPhpExtension.php``

in both files i added pieces of code to help you.

Once it works you should have your library fully loaded into the main project 

and be able to inject and use the TodosClient in any controller you want.


## Next steps

* Test your configuration in ``Tests\Ekino\VwHttpClients\Bridge\Symfony\DependencyInjection\HandsOnEkinoPhpExtensionTest``
* Write the documentation associated, a quick definition of the lib and how to install it.

Congratz, now submit your Pull Request !
