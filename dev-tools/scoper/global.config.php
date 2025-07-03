<?php

declare(strict_types=1);

return [
    // The prefix configuration. If a non-null value is used, a random prefix
    // will be generated instead.
    //
    // For more see: https://github.com/humbug/php-scoper/blob/master/docs/configuration.md#prefix
    'prefix'                  => 'MyPluginNamespace',

    // When scoping PHP files, there will be scenarios where some of the code being scoped indirectly references the
    // original namespace. These will include, for example, strings or string manipulations. PHP-Scoper has limited
    // support for prefixing such strings. To circumvent that, you can define patchers to manipulate the file to your
    // heart contents.
    //
    // For more see: https://github.com/humbug/php-scoper/blob/master/docs/configuration.md#patchers
    'patchers'                => [
        static function ( string $file_path, string $prefix, string $contents ): string {
            // Change the contents here.
        
            return $contents;
        },
    ],

    // List of symbols to consider internal i.e. to leave untouched.
    //
    // For more information see: https://github.com/humbug/php-scoper/blob/master/docs/configuration.md#excluded-symbols
    'exclude-namespaces'      => [
        // 'Acme\Foo'                     // The Acme\Foo namespace (and sub-namespaces)
        // '~^PHPUnit\\\\Framework$~',    // The whole namespace PHPUnit\Framework (but not sub-namespaces)
        // '~^$~',                        // The root namespace only
        'Elementor',
        'PHP_CodeSniffer',
        'PHPCompatibility',
        'Symfony\Polyfill'
    ],
    'exclude-classes'         => [
        'WP_HTTP_Response',
        'WP_REST_Request',
        'WP_REST_Server',
        'WP_Error',
        'wpdb',
        'WP',
        // 'ReflectionClassConstant',
    ],
    'exclude-functions'       => [
        'get_plugin_data',
        'dbDelta'
    ],
    'exclude-constants'       => [
        '/^SYMFONY\_[\p{L}_]+$/',
        // 'STDIN',
    ],

    // List of symbols to expose.
    //
    // For more information see: https://github.com/humbug/php-scoper/blob/master/docs/configuration.md#exposed-symbols
    'expose-global-constants' => true,
    'expose-global-classes'   => true,
    'expose-global-functions' => true,
    'expose-namespaces'       => [
        // 'Acme\Foo'                     // The Acme\Foo namespace (and sub-namespaces)
        // '~^PHPUnit\\\\Framework$~',    // The whole namespace PHPUnit\Framework (but not sub-namespaces)
        // '~^$~',                        // The root namespace only
        'Elementor'
    ],
    'expose-classes'          => [],
    'expose-functions'        => [],
    'expose-constants'        => [],
];