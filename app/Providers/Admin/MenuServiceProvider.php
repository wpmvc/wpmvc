<?php

namespace MyPluginNamespace\App\Providers\Admin;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Contracts\Provider;
use MyPluginNamespace\WpMVC\View\View;

class MenuServiceProvider extends Provider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        add_action( 'admin_menu', [$this, 'action_admin_menu'] );
    }

    /**
     * Action to register the admin menu and submenus.
     *
     * @return void
     */
    public function action_admin_menu() {
        add_menu_page( "MyPluginName", 'MyPluginName', 'manage_options', 'MyPluginTextDomain-menu', function () { }, 'dashicons-admin-generic', 30 );
        add_submenu_page( 'MyPluginTextDomain-menu', esc_html__( 'Overview', 'MyPluginTextDomain' ), esc_html__( 'Overview', 'MyPluginTextDomain' ), 'manage_options', 'MyPluginTextDomain', [$this, 'overview'] );
        add_submenu_page( 'MyPluginTextDomain-menu', esc_html__( 'Settings', 'MyPluginTextDomain' ), esc_html__( 'Settings', 'MyPluginTextDomain' ), 'manage_options', 'MyPluginTextDomain/settings',[$this, 'settings'] );

        remove_submenu_page( 'MyPluginTextDomain-menu', 'MyPluginTextDomain-menu' );
    }

    /**
     * Render the overview page content.
     *
     * @return void
     */
    public function overview() {
        View::render( 'index' );
    }

    /**
     * Render the settings page content.
     *
     * @return void
     */
    public function settings() {
        View::render( 'settings' );
    }
}