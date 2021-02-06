<?php

use App\Core\{App,Config};
use App\Core\Database\{QueryBuilder,Connection};

App::bind('config',Config::load('config.ini')->getConfig());

App::bind('database', new QueryBuilder(Connection::make(App::get('config')['database'])));
