<?php

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\App;
use MyPluginNamespace\Database\Setup;

/**
 * Plugin Name:       MyPluginName
 * Description:       This plugin is build with WpMVC framework
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Tested up to:      6.2
 * Author:            WpMVC
 * Author URI:        http://github.com/wpmvc
 * License:           GPL v3 or later
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       MyPluginTextDomain
 * Domain Path:       /languages
 */

require_once __DIR__ . '/vendor/vendor-src/autoload.php';
require_once __DIR__ . '/app/Helpers/helper.php';

final class MyPluginClass
{
    public static MyPluginClass $instance;

    public static function instance(): MyPluginClass {
        if ( empty( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function load() {
        // Run Activation Tasks
        register_activation_hook(
            __FILE__, function() {
                ( new Setup )->execute();
            } 
        );

        $application = App::instance();

        $application->boot( __FILE__, __DIR__ );

        /**
         * Fires once activated plugins have loaded.
         *
         */
        add_action(
            'plugins_loaded', function () use ( $application ): void {

                do_action( 'before_load_my_plugin_hook' );

                $application->load();

                do_action( 'after_load_my_plugin_hook' );
            }
        );
    }
}

MyPluginClass::instance()->load();
