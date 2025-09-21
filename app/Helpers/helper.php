<?php

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\App;
use MyPluginNamespace\DI\Container;

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

function my_plugin_function_singleton( string $class ) {
    return my_plugin_function_container()->get( $class );
}

function my_plugin_function_url( string $url = '' ) {
    return my_plugin_function()->get_url( $url );
}

function my_plugin_function_dir( string $dir = '' ) {
    return my_plugin_function()->get_dir( $dir );
}
