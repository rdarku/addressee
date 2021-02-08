<?php
	
	use App\Core\{App, Config};
	use App\Core\Database\{QueryBuilder, Connection};
	
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	App::bind('config', Config::load('config.ini')->getConfig());
	
	App::bind('database',
		new QueryBuilder(
			Connection::make(App::get('config')[App::get('config')['database_environment']])
		)
	);
