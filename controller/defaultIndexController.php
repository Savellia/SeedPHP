<?php
	namespace App\controller;

	use App\model\defaultIndexModel as defaultIndexModel;

	class defaultIndexController{
		// It's your first function in the controller, edit it as you want.
		static function helloWorldFromAll(){
			$data["controller"] = array('Hello world from the controller !');
			$data["model"] = defaultIndexModel::helloWorld();
			return $data;
		}

		// Gateway to send information in the view.
		static function view(){
			return defaultIndexController::helloWorldFromAll();
		}
	}
?>