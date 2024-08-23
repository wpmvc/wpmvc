<?php

namespace MyPluginNamespace\App\Models;

use MyPluginNamespace\WpMVC\App;
use MyPluginNamespace\WpMVC\Database\Eloquent\Model;
use MyPluginNamespace\WpMVC\Database\Resolver;

class UserMeta extends Model {
    public static function get_table_name():string {
        return 'usermeta';
    }

    public function resolver():Resolver {
        return App::$container->get( Resolver::class );
    }
}