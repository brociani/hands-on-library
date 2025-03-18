## Tutorial : 

Thanks for participating in this Hands On.

We will see how to create a Library in php

first of all, create your own branch from this current branch (tutorial)
using your name.

run the docker using ```make infra-up```

In the container, init the Library using ```composer init```

once it's done, you should have a composer.json, with the name of your package (Warning it should be pre-fixex with ```hands-on-ekino-php/your-client```)

now we will require our dependency : 

```"symfony/http-client": "^7.2"```

and our dev dependencies :
```
"friendsofphp/php-cs-fixer": "^3",
"symfony/config": "^7.2",
"symfony/dependency-injection": "^7.2",
"symfony/http-kernel": "^7.2",
"phpunit/phpunit": "^12.0",
"phpstan/phpstan": "^2.1",
"phpstan/phpstan-phpunit": "^2.0"
```

Let's create the features ! 