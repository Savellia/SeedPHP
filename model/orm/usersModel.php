<?php
		namespace App\model\orm;

		use App\orm as orm; 
		use App\sql as sql; 

		class usersModel extends orm {

			private $concat;
			public $id;
			public $name;
			public $mail;
			public $pass;

		}
?>
