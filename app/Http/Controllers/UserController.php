<?php

namespace MyPluginNamespace\App\Http\Controllers;

defined( 'ABSPATH' ) || exit;

use MyPluginNamespace\WpMVC\Routing\Response;

class UserController extends Controller
{
    public function index() {
        return Response::send( ['message' => 'Hello WpMVC'] );
    }
}