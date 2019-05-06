<?php
	namespace App;

	class debug {
		static function that($var){
			$result = print_r($var, true);
			echo "<pre>";
			echo $result;
			echo "</pre>";
		}
	
		static function all(){
			global $view;
			global $controllerName;
			$modelName = str_replace("Controller", "Model", $controllerName);
			$viewName = explode("/", $_SERVER["SCRIPT_NAME"]);
			$viewName = $viewName[count($viewName)-2]."/".end($viewName);

			if(!is_array($view)){ $view = []; }

			if(count($view) > 0){
				$viewData = $view;
			}else{
				$viewData = "No data.";
			}

			if(count($_GET) > 0){
				$getData = $_GET;
			}else{
				$getData = 'No data.';
			}

			if(count($_POST) > 0){
				$postData = $_POST;
			}else{
				$postData =  "No data.";
			}

			if(count($_FILES) > 0){
				$filesData = $_FILES;
			}else{
				$filesData =  "No data.";
			}

			if(isset($_SESSION)) {
				if(count($_SESSION) > 0){
					$sessionData = $_SESSION;
				}else{
					$sessionData = "No data.";
				}
			}else{
				$sessionData = "No data.";
			}

			if(isset($_ENV["sqlDebugAll"])) {
				if(count($_ENV["sqlDebugAll"]) > 0){
					$cpt = 0;
					foreach($_ENV["sqlDebugAll"] as $line){
						$sqlData[] = $line;
						$cpt++;
					}
					unset($_ENV["sqlDebugAll"]);
					if($cpt == 0){
						$sqlData = "No data.";
					}
				}else{
					$sqlData = "No data.";
				}
			}else{
				$sqlData = "No data.";
			}

			$unit = array('b','kb','mb','gb','tb','pb');
			$moreData["memoryImpact"] = @round(memory_get_usage(true)/pow(1024,($i=floor(log(memory_get_usage(true),1024)))),3).' '.$unit[$i];

			if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on'){
				$moreData["communication"] = 'HTTPS';
			}else{
				$moreData["communication"] = 'HTTP';
			}

			$moreData["phpVersion"] = phpversion().'<br>';

			echo "<style>@import url(https://fonts.googleapis.com/css?family=Droid+Serif:400,700);@import url(https://fonts.googleapis.com/css?family=Raleway:100,400,700);.pc-tab section>div,.pc-tab>input{display:none}#tab1:checked~section .tab1,#tab2:checked~section .tab2,#tab3:checked~section .tab3,#tab4:checked~section .tab4,#tab5:checked~section .tab5,#tab6:checked~section .tab6,#tab7:checked~section .tab7{min-height:45vh;display:block}#tab1:checked~nav .tab1,#tab2:checked~nav .tab2,#tab3:checked~nav .tab3,#tab4:checked~nav .tab4,#tab5:checked~nav .tab5,#tab6:checked~nav .tab6,#tab7:checked~nav .tab7{color:red}*,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.m-0{margin:0}#debugButton{position:fixed;z-index:101;margin:8px;color:#fff;background:#f44;cursor:pointer;border:0;border-radius:50%;box-shadow:0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);width:2vw;height:2vw;font-size:1vw;bottom:.3vh;left:0}.pc-tab{width:100%;max-width:700px;margin:0 auto;z-index:100;position:fixed;bottom:3.1vh;left:1.2vw}.pc-tab ul{list-style:none;margin:0;padding:0}.pc-tab ul li label{margin-bottom:0!important;font-family:Raleway;float:left;padding:15px 25px;border:1px solid #ddd;border-bottom:0;background:#eee;color:#444}.pc-tab ul li label:hover{background:#ddd}.pc-tab ul li label:active{background:#fff}.pc-tab ul li:not(:last-child) label{border-right-width:0}.pc-tab section{text-align:left;font-family:'Droid Serif';clear:both;height:45vh;min-height:45vh;overflow:overlay}.pc-tab section div{padding:20px;width:100%;border:1px solid #ddd;background:#fff;line-height:1.5em;letter-spacing:.3px;color:#444}.pc-tab section div h2{margin:0;font-family:Raleway;letter-spacing:1px;color:#34495e}#tab1:checked~nav .tab1 label,#tab2:checked~nav .tab2 label,#tab3:checked~nav .tab3 label,#tab4:checked~nav .tab4 label,#tab5:checked~nav .tab5 label,#tab6:checked~nav .tab6 label,#tab7:checked~nav .tab7 label{margin-bottom:0!important;background:#fff;color:#111;position:relative}#tab1:checked~nav .tab1 label:after,#tab2:checked~nav .tab2 label:after,#tab3:checked~nav .tab3 label:after,#tab4:checked~nav .tab4 label:after,#tab5:checked~nav .tab5 label:after,#tab6:checked~nav .tab6 label:after,#tab7:checked~nav .tab7 label:after{margin-bottom:0!important;content:'';display:block;position:absolute;height:2px;width:100%;background:#fff;left:0;bottom:-1px}pre{overflow:auto}</style>

				<button id='debugButton' onclick='debugAll()'>&#9874;</button>
				<div class='pc-tab' id='debugContainer'>
					<input checked='checked' id='tab1' type='radio' name='pct' />
					<input id='tab2' type='radio' name='pct' />
					<input id='tab3' type='radio' name='pct' />
					<input id='tab4' type='radio' name='pct' />
					<input id='tab5' type='radio' name='pct' />
					<input id='tab6' type='radio' name='pct' />
					<input id='tab7' type='radio' name='pct' />
					<nav>
						<ul>
							<li class='tab1'>
								<label for='tab1'>VIEW</label>
							</li>
							<li class='tab2'>
								<label for='tab2'>GET</label>
							</li>
							<li class='tab3'>
								<label for='tab3'>POST</label>
							</li>
							<li class='tab4'>
								<label for='tab4'>FILES</label>
							</li>
							<li class='tab5'>
								<label for='tab5'>SQL</label>
							</li>
							<li class='tab6'>
								<label for='tab6'>SESSION</label>
							</li>
							<li class='tab7'>
								<label for='tab7'>+</label>
							</li>
						</ul>
					</nav>
					<section>
						<div class='tab1'>
							<pre class='m-0'><strong>Model:</strong> ".$modelName."</pre>
							<pre class='m-0'><strong>View:</strong> ".$viewName."</pre>
							<pre class='m-0'><strong>Controller:</strong> ".$controllerName."</pre>
							<pre class='m-0'><strong>Data in \$view:</strong><br>".print_r($viewData, true)."</pre>
						</div>
						<div class='tab2'>
							<pre class='m-0'>".print_r($getData, true)."</pre>
						</div>
						<div class='tab3'>
							<pre class='m-0'>".print_r($postData, true)."</pre>
						</div>
						<div class='tab4'>
							<pre class='m-0'>".print_r($filesData, true)."</pre>
						</div>
						<div class='tab5'>
							<pre class='m-0'>".print_r($sqlData, true)."</pre>
						</div>
						<div class='tab6'>
							<pre class='m-0'>".print_r($sessionData, true)."</pre>
						</div>
						<div class='tab7'>
							<pre class='m-0'><strong>Memory impact:</strong> ".$moreData["memoryImpact"]."</pre>
							<pre class='m-0'><strong>Communication:</strong> ".$moreData["communication"]."</pre>
							<pre class='m-0'><strong>PHP version:</strong> ".$moreData["phpVersion"]."</pre>
						</div>
					</section>
				</div>";
			echo '<script>function debugAll() { var x = document.getElementById("debugContainer"); if (x.style.display === "none") { x.style.display = "block"; } else { x.style.display = "none"; } } </script>';
		}

	}
?>
