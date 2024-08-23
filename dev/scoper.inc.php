<?php

declare(strict_types=1);

use Isolated\Symfony\Component\Finder\Finder;

// You can do your own things here, e.g. collecting symbols to expose dynamically
// or files to exclude.
// However beware that this file is executed by PHP-Scoper, hence if you are using
// the PHAR it will be loaded by the PHAR. So it is highly recommended to avoid
// to auto-load any code here: it can result in a conflict or even corrupt
// the PHP-Scoper analysis.

// Example of collecting files to include in the scoped build but to not scope
// leveraging the isolated finder.
$polyfills_bootstraps = array_map(
    static fn ( SplFileInfo $file_info ) => $file_info->getPathname(),
    iterator_to_array(
        Finder::create()
            ->files()
            ->in( __DIR__ . '/../vendor-src/symfony/polyfill-*' )
            ->name( 'bootstrap*.php' ),
        false,
    ),
);

$polyfills_stubs = array_map(
    static fn ( SplFileInfo $file_info ) => $file_info->getPathname(),
    iterator_to_array(
        Finder::create()
            ->files()
            ->in( __DIR__ . '/../vendor-src/symfony/polyfill-*/Resources/stubs' )
            ->name( '*.php' ),
        false,
    ),
);

return [
    // The prefix configuration. If a non-null value is used, a random prefix
    // will be generated instead.
    //
    // For more see: https://github.com/humbug/php-scoper/blob/master/docs/configuration.md#prefix
    'prefix'                  => 'MyPluginNamespace',

    // By default when running php-scoper add-prefix, it will prefix all relevant code found in the current working
    // directory. You can however define which files should be scoped by defining a collection of Finders in the
    // following configuration key.
    //
    // This configuration entry is completely ignored when using Box.
    //
    // For more see: https://github.com/humbug/php-scoper/blob/master/docs/configuration.md#finders-and-paths
    'finders'                 => [
        Finder::create()
            ->files()
            ->followLinks()
            ->ignoreVCS( true )
            ->notName( '/LICENSE|.*\\.md|.*\\.dist|Makefile' )
            ->exclude(
                [
                    'doc',
                    'test',
                    'test_old',
                    'tests',
                    'Tests',
                    'vendor-bin'
                ]
            )
            ->in( 'vendor-src/wpmvc' )

    ],

    // List of excluded files, i.e. files for which the content will be left untouched.
    // Paths are relative to the configuration file unless if they are already absolute
    //
    // For more see: https://github.com/humbug/php-scoper/blob/master/docs/configuration.md#patchers
    'exclude-files'           => [
        __DIR__ . '/../vendor-src/php-di/php-di/src/Compiler/Template.php',
        ...$polyfills_bootstraps,
        ...$polyfills_stubs,
    ],

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
        'get_plugin_data'
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