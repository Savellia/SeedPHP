<?php
	namespace App;

	class session{
		static public function start(){
			@session_start();
		}

		static public function destroy(){
			session_destroy();
		}
	}
	if($_ENV['session']){
		session::start();
	}
?>
