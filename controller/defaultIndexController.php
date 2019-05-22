<?php
	namespace App\controller;

	use App\model\defaultIndexModel as defaultIndexModel;
	use App\mail as mail;

	class defaultIndexController{
		// It's your first function in the controller, edit it as you want.
		static function helloWorldFromAll(){
			$data["controller"] = array('Hello world from the controller !');
			$data["model"] = defaultIndexModel::helloWorld();

			$mail = new mail();

			$mail->to("adriensavelli@live.fr");
			$mail->from("adriensavelli@gmail.com");
			//$mail->cc("adriensavelli@gmail.com");
			//$mail->cci("a.savelli@ethymsel.com");


			$mail->replyTo("adriensavelli@gmail.com");

			$mail->isHTML(true);

			$mail->subject("PHP Email with Attachment by CodexWorld");

			$mail->body("<h1>PHP Email with Attachment by CodexWorld</h1><p>This email has sent from PHP script with attachment.</p>", "UTF-8");
			$mail->attachment("C:\Users\Savelli\Downloads\img.png");

			$mail->send();

			return $data;
		}

		// Gateway to send information in the view.
		static function view(){
			return defaultIndexController::helloWorldFromAll();
		}
	}
?>