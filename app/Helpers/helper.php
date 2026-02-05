<?php

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\App;
use MyPluginNamespace\WpMVC\Container\Container;

function my_plugin_function():App {
    return App::$instance;
}

function my_plugin_function_config( string $config_key ) {
    return my_plugin_function()::$config->get( $config_key );
}

function my_plugin_function_app_config( string $config_key ) {
    return my_plugin_function_config( "app.{$config_key}" );
}

function my_plugin_function_version() {
    return my_plugin_function_app_config( 'version' );
}

function my_plugin_function_container():Container {
    return my_plugin_function()::$container;
}

/**
 * Get a singleton instance from the container.
 *
 * @template T
 * @param class-string<T> $class Class name to resolve.
 * @param array $params Parameters to pass to the constructor.
 * @return T Instance of the requested class.
 */
function my_plugin_function_singleton( string $class, array $params = [] ) {
    return my_plugin_function_container()->get( $class, $params );
}

function my_plugin_function_url( string $url = '' ) {
    return my_plugin_function()->get_url( $url );
}

function my_plugin_function_dir( string $dir = '' ) {
    return my_plugin_function()->get_dir( $dir );
}
