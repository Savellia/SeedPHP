<?php
	namespace App;

	$_ENV['dbAccess'] = sql::connect();
	$dbAccess = sql::connect();

	class sql {
		static function connect(){
			if(isset($_ENV['sqlConnector'])){
				try{
					$pdo = new \PDO($_ENV['sqlConnector']["dbDriver"].':host='.$_ENV['sqlConnector']["dbHost"].';dbname='.$_ENV['sqlConnector']["dbName"], $_ENV['sqlConnector']["dbUser"], $_ENV['sqlConnector']["dbPass"]);
				}
				catch(\Exception $e){
					die('Erreur : '.$e->getMessage());
				}
				return $pdo;
			}else{
				return false;
			}
		}

		static function request($request){
			if($_ENV['dbAccess']){
				$pdo_request = $_ENV['dbAccess']->prepare($request);

				if($_ENV["debug"]){
					$_ENV["sqlDebugAll"][] = $request;
				}else{
					unset($_ENV["sqlDebugAll"]);
				}

				if($pdo_request->execute() && strtolower(substr($request, 0, 6))  == "select"){
					$resultData = $pdo_request->fetchAll(\PDO::FETCH_NAMED);
					return $resultData;
				}else{
					if($pdo_request->errorCode() != "00000"){
						return false;
					}else{
						return true;
					}
				}
			}else{
				return "SeedPHP :: Merci de vérifier l'accès à votre base de données.";
			}
		}

		static public function column($table){
			if($_ENV['dbAccess']){
				$pdo_request = $_ENV['dbAccess']->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$_ENV["sqlConnector"]["dbName"]."' AND TABLE_NAME = '".$table."'");
				$pdo_request->execute();
				$result = $pdo_request->fetchAll();
				return $result;
			}else{
				return "SeedPHP :: Merci de vérifier l'accès à votre base de données.";
			}
		}

		static public function table($dbName){
			if($_ENV['dbAccess']){
				$pdo_request = $_ENV['dbAccess']->prepare("SELECT TABLE_NAME  FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='".$dbName."'");
				$pdo_request->execute();
				$result = $pdo_request->fetchAll();
				return $result;
			}else{
				return "SeedPHP :: Merci de vérifier l'accès à votre base de données.";
			}
		}
	}
?>
