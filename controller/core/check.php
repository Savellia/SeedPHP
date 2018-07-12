<?php
	namespace App;

	class check {
	    static function input($variable, $checkup){
	    	$allCheckup = null;
	    	$allCheckup = str_replace(" ", "", $allCheckup);
	    	$allCheckup = explode("|", $checkup);
	    	$returnCheckup = array();

	    	$emailTypeRegex = "/type:email/iD";
	    	$emailRegex = "/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD";

	    	$dateTypeRegex = "/type:date/iD";
	    	$dateRegexF0 = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}\z/";
	    	$dateRegexF1 = "/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}\z/";
	    	$dateRegexF2 = "/^[0-9]{2}-[0-9]{2}-[0-9]{4}\z/";
	    	$dateRegexF3 = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}\z/";

	    	$numberTypeRegex = "/type:number/iD";

	    	$maxRegex = "/max:/iD";
	    	$minRegex = "/min:/iD";

	    	for($cpt = 0 ; $cpt < count($allCheckup) ; $cpt++){

				if($allCheckup[$cpt] == "required"){ // required

					if(strlen($variable) == 0){
		    			$returnCheckup["error"]["required"] = "Content is empty.";
					}
		    		
		    	}elseif(preg_match($emailTypeRegex, $allCheckup[$cpt])){ // type:email

		    		if(!preg_match($emailRegex, $variable)){
		    			$returnCheckup["error"]["email"] = "Not a valid email.";
		    		}

		    	}elseif(preg_match($dateTypeRegex, $allCheckup[$cpt])){ // type:date

		    		if(!preg_match($dateRegexF0, $variable) && !preg_match($dateRegexF1, $variable) && !preg_match($dateRegexF2, $variable) && !preg_match($dateRegexF3, $variable)){
		    			$returnCheckup["error"]["date"] = "Not a valid date.";
		    		}

		    	}elseif(preg_match($numberTypeRegex, $allCheckup[$cpt])){ // type:number

		    		if(!is_numeric($variable)){
		    			$returnCheckup["error"]["number"] = "Not a valid number.";
		    		}

		    	}elseif(preg_match($maxRegex, $allCheckup[$cpt])){ // max:<int>

		    		if(strlen($variable) > substr($allCheckup[$cpt], 4)){
		    			$returnCheckup["error"]["max"] = "Too much characters.";
		    		}
		    		
		    	}elseif(preg_match($minRegex, $allCheckup[$cpt])){ // min:<int>

		    		if(strlen($variable) < substr($allCheckup[$cpt], 4)){
		    			$returnCheckup["error"]["min"] = "not enough characters.";
		    		}
		    		
		    	}else{
		    		// Stop if something wrong.
		    		return $returnCheckup["error"]["parameter"] = "Your second parameter of your function have a problem of consistency.";
		    	}
	    	}

	    	if(!isset($returnCheckup["error"])){
		    	return true;
	    	}else{
	    		return $returnCheckup;
	    	}
	    }
	}
	//$check = new CHECK();

	/**$return = $check->input("1", "required|max:50|type:number");**/
?>
