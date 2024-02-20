<?php

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\App\Http\Middleware\EnsureIsUserAdmin;
use MyPluginNamespace\App\Providers\MenuServiceProvider;
use MyPluginNamespace\Database\Migrations\TestMigration;
use MyPluginNamespace\WpMVC\App;

return [
    'version'                 => get_plugin_data( App::$plugin_root_file )['Version'],

    'rest_api'                => [
        'namespace' => 'MyPluginApiNamespace',
        'versions'  => []
    ],

    'ajax_api'                => [
        'namespace' => 'MyPluginApiNamespace',
        'versions'  => []
    ],

    'providers'               => [],

    'admin_providers'         => [
        MenuServiceProvider::class,
    ],

    'middleware'              => [
        'admin' => EnsureIsUserAdmin::class
    ],

    'migration_db_option_key' => 'my_plugin_hook_migrations',

    'migrations'              => [
        'test-migration' => TestMigration::class,
    ]
];