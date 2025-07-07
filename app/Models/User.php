<?php

namespace MyPluginNamespace\App\Models;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\App;
use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Resolver;

class User extends Model {
    public static function get_table_name():string {
        return 'users';
    }

    public function resolver():Resolver {
        return App::$container->get( Resolver::class );
    }
}