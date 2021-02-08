<?php
	
	namespace App\models;
	
	use App\Core\App;
	
	class States
	{
		protected $table = 'state';
		protected $database;
		
		public function __construct()
		{
			$this->database = App::get('database');
		}
		
		public function getAll()
		{
			return $this->database->selectAll($this->table);
		}
	}