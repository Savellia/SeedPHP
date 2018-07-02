<?php
	namespace App\controller;

	use App\model\defaultIndexModel as defaultIndexModel;
	use App\model\orm\usersModel as usersModel;

	class defaultIndexController{
		// It's your first function in the controller, edit it as you want.
		static function helloWorldFromAll(){
			$data["controller"] = array('Hello world from the controller !');
			$data["model"] = defaultIndexModel::helloWorld();
			$data["orm"] = usersModel::getCount();
			$data["orm2"] = usersModel::findAll();
			return $data;
		}

		// Gateway to send information in the view.
		static function view(){
			return defaultIndexController::helloWorldFromAll();
		}
	}
?>