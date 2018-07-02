<?php
	namespace App\model;

	use App\sql as sql;
	use App\orm as orm;

	class defaultIndexModel{
		// It's your first function in the model, edit it as you want. (ORM, PDO...)
		static function helloWorld(){
			$data = array('Hello world from the model !');
			return $data;
		}
	}
?>