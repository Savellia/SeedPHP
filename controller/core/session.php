<?php
	namespace App;

	class session{
		public function start(){
			@session_start();
		}

		public function destroy(){
			session_destroy();
		}
	}
	if($_ENV['session']){
		$session = new session();
		$session->start();
	}
?>
