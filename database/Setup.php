<?php

namespace MyPluginNamespace\Database;

use MyPluginNamespace\WpMVC\Database\Schema\Schema;

defined( 'ABSPATH' ) || exit;

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