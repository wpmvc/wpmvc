<?php

namespace MyPluginNamespace\Database;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Database\Schema\Schema;

class Setup {
    public function execute() {
        // Schema::create(
        //     'wpmvc_test', function( $table ) {
        //         $table->big_increments( 'id' );
        //         $table->string( 'title' )->nullable();
        //         $table->timestamps();
        //     }
        // );
    }
}