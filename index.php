<?php

require_once ('vendor/autoload.php');

require_once 'core/bootstrap.php';

use App\Core\{Router,Request};

Router::load(__DIR__ . '/app/routes.php')
    ->direct(Request::uri(), Request::method());
