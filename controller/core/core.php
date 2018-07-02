<?php
	namespace App;

	class core {
		static function getPath() {
			$pathFound = true;
			$path = "";
			$pathController = "controller/";
			$pathModel = "model/";

			// Rechercher dans l'arborescence les dossiers controller/ et model/.
			while($pathFound){
				if(file_exists($pathController) && file_exists($pathModel)){
					$pathFound = false;
					return $path;
				}else{
					$path = "../".$path;
					$pathController = "../".$pathController;
					$pathModel = "../".$pathModel;
				}
			}
		}
		static function getViewPath() {
			$pathFound = true;
			$path = "";
			$pathView = "view/";

			// Rechercher dans l'arborescence les dossiers view/.
			while($pathFound){
				if(file_exists($pathView)){
					$pathFound = false;
					return $path."view/";
				}else{
					$path = "../".$path;
					$pathView = "../".$pathView;
				}
			}
		}

		function contentLoader($path) {
			$pathModel = $path."model/";
			$pathController = $path."controller/";
			$pathControllerCore = $path."controller/core/";
			$pathModelOrm = $path."model/orm/";
			$contentModel = array_slice(scandir($pathModel),2);
			$contentModelOrm = array_slice(scandir($pathModelOrm),2);
			$contentController = array_slice(scandir($pathController),2);
			$contentControllerCore = array_slice(scandir($pathControllerCore),2);

			// Chargement du fichier config.php.
			require $path."config.php";

			// Chargement du contenu du dossier controller/core/.
			foreach ($contentControllerCore as $item){
				if($item != "core.php"){
					require $pathControllerCore.$item;
				}
			}

			// Chargement du contenu du dossier model/orm/.
			if($_ENV["orm_access"]){
				foreach ($contentModelOrm as $item){
					require $pathModelOrm.$item;
				}
			}

			// Chargement du contenu du dossier model/.
			foreach ($contentModel as $item){
				if($item != "orm"){
					require $pathModel.$item;
				}
			}

			// Chargement du contenu du dossier controller/.
			foreach ($contentController as $item){
				if($item != "core"){
					require $pathController.$item;
				}
			}
		}

		function controllerData($path){
			$controllerName = explode("/view/",$_SERVER['SCRIPT_FILENAME']);
			$controllerName = explode("/",$controllerName[1]);
			$controllerNameTmp = explode(".",end($controllerName));
			$controllerFilename = ucfirst(strtolower(reset($controllerNameTmp)))."Controller";
			array_pop($controllerName);
			$controllerFinalName = "";
			$cpt = 0;

			// Formatage du chemin du controleur.
			foreach($controllerName as $folderModel){
				if($cpt == 0){
					$controllerFinalName = strtolower($folderModel);
				}else{
					$controllerFinalName = $controllerFinalName.ucfirst(strtolower($folderModel));
				}
				$cpt++;
			}

			$controllerData["folder"] = $controllerFinalName.$controllerFilename;
			$controllerData["path"] = $path."controller/".$controllerData["folder"].".php";
			return $controllerData;
		}
	}
	$core = new core();
	$path = $core->getPath();
	$core->contentLoader($path);
	$controllerPath = $core->controllerData($path)["path"];
	$controllerName = $core->controllerData($path)["folder"];
	$modelOrmPath = $path."model/orm/";

	if(file_exists($controllerPath)){
		$controllerInit = "
		use App\controller\\$controllerName as $controllerName;
		\$view = $controllerName::view();";
		eval($controllerInit);
	}


	if($_ENV['debug']){
		$debug = new debug();
		$debug->all();
	}

	//echo "<pre>";
	//	print_r($view);
	//echo "<pre>";
?>