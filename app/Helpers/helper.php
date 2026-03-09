<?php

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\App;
use MyPluginNamespace\WpMVC\Container\Container;
use MyPluginNamespace\WpMVC\Helpers\Date;

/**
 * Get the application instance.
 *
 * @return App
 */
function my_plugin_function(): App {
    return App::$instance;
}

/**
 * Get the configuration value.
 *
 * @param string $config_key The configuration key.
 * @return mixed
 */
function my_plugin_function_config( string $config_key ) {
    return my_plugin_function()::get_config()->get( $config_key );
}

/**
 * Get the application configuration value.
 *
 * @param string $config_key The configuration key.
 * @return mixed
 */
function my_plugin_function_app_config( string $config_key ) {
    return my_plugin_function_config( "app.{$config_key}" );
}

/**
 * Get the plugin version.
 *
 * @return string
 */
function my_plugin_function_version(): string {
    return my_plugin_function_app_config( 'version' );
}

/**
 * Get the container instance.
 *
 * @return Container
 */
function my_plugin_function_container(): Container {
    return my_plugin_function()::get_container();
}

/**
 * Resolve a service instance from the container.
 *
 * @template T
 * @param class-string<T> $class Service ID or class name to resolve.
 * @param array $params Parameters for resolution.
 * @return T
 */
function my_plugin_function_resolve( string $class, array $params = [] ) {
    return my_plugin_function_container()->get( $class, $params );
}

/**
 * Create a new instance of the given class (Factory).
 *
 * @template T
 * @param class-string<T> $class Class name to resolve.
 * @param array $params Parameters for the constructor.
 * @return T A new instance.
 */
function my_plugin_function_make( string $class, array $params = [] ) {
    return my_plugin_function_container()->make( $class, $params );
}

/**
 * Get the plugin URL.
 *
 * @param string $url Optional. Extra path to append to the URL.
 * @return string
 */
function my_plugin_function_url( string $url = '' ): string {
    return my_plugin_function()->get_url( $url );
}

/**
 * Get the plugin directory path.
 *
 * @param string $dir Optional. Extra path to append to the directory.
 * @return string
 */
function my_plugin_function_dir( string $dir = '' ): string {
    return my_plugin_function()->get_dir( $dir );
}

/**
 * Get a new Date instance for 'now'.
 *
 * @param DateTimeZone|null $timezone Optional. The timezone. Defaults to wp_timezone().
 * @return Date
 */
function my_plugin_function_now( ?DateTimeZone $timezone = null ): Date {
    return Date::now( $timezone );
}