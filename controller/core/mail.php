<?php
	namespace App;

	class mail {
		
		static public $headers;
		static public $content;
		static public $mime_boundary;

		function __construct() {

			self::$mime_boundary = "==Multipart_Boundary_x".md5(time())."x";
		}

		static function from($mailFrom, $nameFrom = null){

			if($nameFrom != null){
				self::$headers["From: "] = "$nameFrom <$mailFrom>";
			}else{
				self::$headers["From: "] = "$mailFrom";
			}
		}

		static function to($mailTo){

			if(!isset(self::$headers["to"]) && empty(self::$headers["to"])){
				self::$headers["To: "] = "$mailTo";
			}else{
				self::$headers["To: "] .= ",$mailTo";
			}
		}

		static function replyTo($mailReplyTo, $nameReplyTo = null){

			if($nameReplyTo != null){
				self::$headers["Reply-To: "] = "$nameReplyTo <$mailReplyTo>";
			}else{
				self::$headers["Reply-To: "] = "$mailReplyTo";
			}
		}

		static function cc($mailCc){

			if(!isset(self::$headers["cc"]) && empty(self::$headers["cc"])){
				self::$headers["Cc: "] = "$mailCc";
			}else{
				self::$headers["Cc: "] .= ",$mailCc";
			}
		}

		static function bcc($mailBcc){

			if(!isset(self::$headers["bcc"]) && empty(self::$headers["bcc"])){
				self::$headers["Bcc: "] = "$mailBcc";
			}else{
				self::$headers["Bcc: "] .= ",$mailBcc";
			}
		}

		static function cci($mailCci){

			if(!isset(self::$headers["bcc"]) && empty(self::$headers["bcc"])){
				self::$headers["Bcc: "] = "$mailCci";
			}else{
				self::$headers["Bcc: "] .= ",$mailCci";
			}
		}

		static function subject($data){

			self::$content["subject"] = $data;
		}

		static function body($data, $charset = null){

			self::$content["body"] = "--".self::$mime_boundary." \n";

			if($charset != null){
				self::$content["body"] .= "Content-Type: text/html; charset=\"$charset\" \n";
			}else{
				self::$content["body"] .= "Content-Type: text/html; charset=iso-8859-1 \n";
			}

			self::$content["body"] .= "Content-Transfer-Encoding: 7bit \n\n";
			self::$content["body"] .= $data."\n\n";
		}

		static function send(){

			$finalHeader = "";
			foreach (self::$headers as $key => $value) {

				if($key != "html"){
					if($key != "To: "){
						$finalHeader .= $key.$value."\r\n";	
					}
				}else{
					$finalHeader .= $value."\r\n";
				}
			}

			return mail(self::$headers["To: "], self::$content["subject"], self::$content["body"], $finalHeader);
		}


		static function attachment($attachmentPath){

			$mime_boundary = "==Multipart_Boundary_x".md5(time())."x";

			if(!isset(self::$headers["attachment"]) && empty(self::$headers["attachment"])){
				self::$headers["html"] = "MIME-Version: 1.0 \n";
				self::$headers["html"] .= "Content-Type: multipart/mixed; \n";
				self::$headers["html"] .= " boundary=\"".self::$mime_boundary."\"";

				if(!empty($attachmentPath) > 0){
				    if(is_file($attachmentPath)){
				        self::$content["body"] .= "--".self::$mime_boundary." \n";
				        $fp =    @fopen($attachmentPath,"rb");
				        $data =  @fread($fp,filesize($attachmentPath));

				        @fclose($fp);
				        $data = chunk_split(base64_encode($data));

				        self::$content["body"] .= "Content-Type: application/octet-stream;";
						self::$content["body"] .= "name=\"".basename($attachmentPath)."\" \n";
						self::$content["body"] .= "Content-Description: ".basename($attachmentPath)." \n";
						self::$content["body"] .= "Content-Disposition: attachment; \n";
						self::$content["body"] .= "filename=\"".basename($attachmentPath)."\";";	
						self::$content["body"] .= "size=".filesize($attachmentPath).";\n";
						self::$content["body"] .= "Content-Transfer-Encoding: base64 \n\n";
						self::$content["body"] .= $data . "\n\n";
				    }
				}

				self::$content["body"] .= "--".self::$mime_boundary."--";
			}
		}
	}
	/**
		$mail = new mail();
		$mail->to("***");
		$mail->from("***");
		$mail->cc("***");
		$mail->cci("***");
		$mail->bcc("***");
		$mail->replyTo("***");
		$mail->subject("***");
		$mail->body("***");
		$mail->send();
	**/
?>
