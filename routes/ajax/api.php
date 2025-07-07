<?php

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\App\Http\Controllers\UserController;
use MyPluginNamespace\WpMVC\Routing\Ajax;

Ajax::get( 'user/{id}', [UserController::class, 'index'], ['admin'] );
