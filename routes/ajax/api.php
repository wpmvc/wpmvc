<?php

use MyPluginNamespace\App\Http\Controllers\UserController;

use MyPluginNamespace\WaxFramework\Routing\Ajax;

Ajax::get('user/{id}', [UserController::class, 'index'], ['admin']);
