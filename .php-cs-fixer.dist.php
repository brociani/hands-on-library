<?php

/**
 * This file is part of the hands-on-ekino-php/your-client project.
 *
 * (c) Ekino
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$header = <<<EOF
This file is part of the hands-on-ekino-php/your-client project.

(c) Ekino

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$finder = PhpCsFixer\Finder::create()
    ->in(['src', 'tests'])
;

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'declare_strict_types' => true,
        'header_comment' => ['header' => $header],
        'no_useless_else' => true,
        'no_useless_return' => true,
        'php_unit_strict' => true,
        'phpdoc_order' => true,
        'strict_comparison' => true,
        'strict_param' => true,
    ])
    ->setUsingCache(true)
    ->setFinder($finder)
    ;
