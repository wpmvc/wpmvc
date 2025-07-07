<?php

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\App\Http\Controllers\UserController;
use MyPluginNamespace\WpMVC\Routing\Route;

Route::get( 'user', [UserController::class, 'index'], ['admin'] );