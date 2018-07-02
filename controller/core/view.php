<?php
	namespace App;

	use App\core;

	class view{

		private $concat;

		static public function data($method, $content, $view = false){
			if(strtolower($method) == "post"){
				$_SESSION["seedPHP_Method_TmpTravelTime"] = $method;
				$_SESSION["seedPHP_Data_TmpTravelTime"] = $content;

				if($view){
					$_SESSION["seedPHP_View_TmpTravelTime"] = $view.".php";
					$path = core::getViewPath();

					return header("Location: $path$view.php");
				}
			}
		}
		static public function redirect($view){
			return header("Location: $view");
		}
	}
	//$view = new view();
?>
