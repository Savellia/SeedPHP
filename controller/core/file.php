<?php
	namespace App;

	class file{
		static function name($file){
			$file = basename($file);
			$file = explode(".", $file);
			return $file[0];
		}

		static function extension($file){
			$file = strrchr($file,'.');
			$file = str_replace('.', NULL, $file);
			return $file;
		}

		static function upload($file,$path,$name){
			if($file["error"] == 0){
				$tmp_name = $file["tmp_name"];
				$name = $name.".".file::extension($file["name"]);
				move_uploaded_file($tmp_name, $path.$name);
				return true;
			}else { 
				return false; 
			}
		}
	}
?>