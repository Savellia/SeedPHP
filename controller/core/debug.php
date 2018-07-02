<?php
	namespace App;

	class debug {
		function that($var){
			$result = print_r($var, true);
			echo "<pre>";
			echo $result;
			echo "</pre>";
		}
	
		function all(){
			global $view;
			global $controllerName;
			$modelName = str_replace("Controller", "Model", $controllerName);
			$viewName = explode("/", $_SERVER["SCRIPT_NAME"]);
			$viewName = $viewName[count($viewName)-2]."/".end($viewName);

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

			$unit = array('b','kb','mb','gb','tb','pb');
			$moreData["memoryImpact"] = @round(memory_get_usage(true)/pow(1024,($i=floor(log(memory_get_usage(true),1024)))),3).' '.$unit[$i];

			if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on'){
				$moreData["communication"] = 'HTTPS';
			}else{
				$moreData["communication"] = 'HTTP';
			}

			$moreData["phpVersion"] = phpversion().'<br>';

			echo "<style>@import url(https://fonts.googleapis.com/css?family=Droid+Serif:400,700);@import url(https://fonts.googleapis.com/css?family=Raleway:100,400,700);.pc-tab section>div,.pc-tab>input{display:none}#tab1:checked~section .tab1,#tab2:checked~section .tab2,#tab3:checked~section .tab3,#tab4:checked~section .tab4,#tab5:checked~section .tab5,#tab6:checked~section .tab6,#tab7:checked~section .tab7{display:block}#tab1:checked~nav .tab1,#tab2:checked~nav .tab2,#tab3:checked~nav .tab3,#tab4:checked~nav .tab4,#tab5:checked~nav .tab5,#tab6:checked~nav .tab6,#tab7:checked~nav .tab7{color:red}*,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}#debugButton{position:fixed;z-index:101;margin:8px;color:#fff;background:#f44;cursor:pointer;border:0;border-radius:50%;box-shadow:0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12);width:2vw;height:2vw;font-size:1vw;bottom:.3vh;left:0}.pc-tab{width:100%;max-width:700px;margin:0 auto;z-index:100;position:fixed;bottom:3.1vh;left:1.2vw}.pc-tab ul{list-style:none;margin:0;padding:0}.pc-tab ul li label{font-family:Raleway;float:left;padding:15px 25px;border:1px solid #ddd;border-bottom:0;background:#eee;color:#444}.pc-tab ul li label:hover{background:#ddd}.pc-tab ul li label:active{background:#fff}.pc-tab ul li:not(:last-child) label{border-right-width:0}.pc-tab section{font-family:'Droid Serif';clear:both;height:45vh;overflow:overlay}.pc-tab section div{padding:20px;width:100%;border:1px solid #ddd;background:#fff;line-height:1.5em;letter-spacing:.3px;color:#444}.pc-tab section div h2{margin:0;font-family:Raleway;letter-spacing:1px;color:#34495e}#tab1:checked~nav .tab1 label,#tab2:checked~nav .tab2 label,#tab3:checked~nav .tab3 label,#tab4:checked~nav .tab4 label,#tab5:checked~nav .tab5 label,#tab6:checked~nav .tab6 label,#tab7:checked~nav .tab7 label{background:#fff;color:#111;position:relative}#tab1:checked~nav .tab1 label:after,#tab2:checked~nav .tab2 label:after,#tab3:checked~nav .tab3 label:after,#tab4:checked~nav .tab4 label:after,#tab5:checked~nav .tab5 label:after,#tab6:checked~nav .tab6 label:after,#tab7:checked~nav .tab7 label:after{content:'';display:block;position:absolute;height:2px;width:100%;background:#fff;left:0;bottom:-1px}</style>

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
							<p><pre><strong>Model:</strong> ".$modelName."</pre></p>
							<p><pre><strong>View:</strong> ".$viewName."</pre></p>
							<p><pre><strong>Controller:</strong> ".$controllerName."</pre></p>
							<p><pre><strong>Data in the view:</strong><br>".print_r($viewData, true)."</pre></p>
						</div>
						<div class='tab2'>
							<p><pre>".print_r($getData, true)."</pre></p>
						</div>
						<div class='tab3'>
							<p><pre>".print_r($postData, true)."</pre></p>
						</div>
						<div class='tab4'>
							<p><pre>".print_r($filesData, true)."</pre></p>
						</div>
						<div class='tab5'>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, nobis culpa rem, vitae earum aliquid.</p>
						</div>
						<div class='tab6'>
							<p><pre>".print_r($sessionData, true)."</pre></p>
						</div>
						<div class='tab7'>
							<p><pre><strong>Memory impact:</strong> ".$moreData["memoryImpact"]."</pre></p>
							<p><pre><strong>Communication:</strong> ".$moreData["communication"]."</pre></p>
							<p><pre><strong>PHP version:</strong> ".$moreData["phpVersion"]."</pre></p>
						</div>
					</section>
				</div>";

			/**echo "
				<style>
					#debugContainer {
					  margin: 0 auto;
					  width: 99%;
						font-family: Arial, sans;
						z-index: 100;
						position: fixed;
						bottom: 0;
						display: inline;
					}

					#debugButton{
						position: fixed;
						bottom: 0;
						z-index: 101;
						left: 0;
						margin: 8px;
						color: white;
						background: #ff4444;
						cursor: pointer;
						border: 0;
						box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
					}

					#debugContainer input {
						height: 2.5em;
						visibility: hidden;
					}

					#debugContainer label {
						background: #f9f9f9;
						border-radius: .25em .25em 0 0;
						color: #888;
						cursor: pointer;
						display: block;
						float: left;
						font-size: 1em;
						height: 2.5em;
						line-height: 2.5em;
						margin-right: .25em;
						padding: 0 1.5em;
						text-align: center;
					}

					#debugContainer input:hover + label {
						background: #ddd;
						color: #666;
					}
					#debugContainer input:checked + label {
						background: #f1f1f1;
						color: #444;
						position: relative;
						z-index: 6;
					}
					#debugContent {
						background: #f1f1f1;
						border-radius: 0 .25em .25em .25em;
						min-height: 17em;
						position: relative;
						width: 100%;
						z-index: 5;
						overflow-y: scroll;
					}
					#debugContent div {
						opacity: 0;
						padding: 1.5em;
						position: absolute;
						z-index: -100;
					}
					#debugContainer input#tab-0:checked ~ #debugContent #debugContent-0, #debugContainer input#tab-1:checked ~ #debugContent #debugContent-1, #debugContainer input#tab-2:checked ~ #debugContent #debugContent-2, #debugContainer input#tab-3:checked ~ #debugContent #debugContent-3, #debugContainer input#tab-4:checked ~ #debugContent #debugContent-4, #debugContainer input#tab-5:checked ~ #debugContent #debugContent-5, #debugContainer input#tab-6:checked ~ #debugContent #debugContent-6 {
					  opacity: 1;
					  z-index: 100;
					}
				</style>";

			echo "
				
				<div id='debugContainer'>
					<input id='tab-0' type='radio' name='tab-group' checked='checked' />
					<label for='tab-0'>VIEW</label>
					<input id='tab-1' type='radio' name='tab-group' />
					<label for='tab-1'>GET</label>
					<input id='tab-2' type='radio' name='tab-group' />
					<label for='tab-2'>POST</label>
					<input id='tab-3' type='radio' name='tab-group' />
					<label for='tab-3'>FILES</label>
					<input id='tab-4' type='radio' name='tab-group' />
					<label for='tab-4'>SQL</label>
					<input id='tab-5' type='radio' name='tab-group' />
					<label for='tab-5'>SESSION</label>
					<input id='tab-6' type='radio' name='tab-group' />
					<label for='tab-6'>+</label>";

					echo "<div id='debugContent'>
							<div id='debugContent-0'><p><pre>
								<b>Vue:</b> ".$parseModel1[1]."
								<b>Contrôleur:</b> ".$folderControllerConcat."
								<b>Modèle:</b> ".$folderModelConcat."<br>
								<b>Données retournées dans la vue:</b> ";
									if(count($viewConcat) > 0){
											$debug->that($viewConcat);
									}else{
										echo "No data.";
									}
					echo "</pre></p></div>";

					echo "<div id='debugContent-1'><p><pre>";
						if(count($_GET) > 0){
							print_r($_GET);
						}else{
							echo 'No data.';
						}
					echo "</pre></p></div>";

					echo "<div id='debugContent-2'><p><pre>";
						if(count($_POST) > 0){
							print_r($_POST);
						}else{
							echo "No data.";
						}
					echo "</pre></p></div>";

					echo "<div id='debugContent-3'><p><pre>";
						if(count($_FILES) > 0){
							print_r($_FILES);
						}else{
							echo "No data.";
						}
					echo "</pre></p></div>";

					echo "<div id='debugContent-4'><p><pre>";
						if(isset($_SESSION["sqlDebugAll"])) {
							if(count($_SESSION["sqlDebugAll"]) > 0){
								$cpt = 0;
								foreach($_SESSION["sqlDebugAll"] as $line){
									if($cpt != 0){
										echo "- ".$line."<br>";
									}
									$cpt++;
								}
								unset($_SESSION["sqlDebugAll"]);
								if($cpt == 1){
									echo "No data.";
								}
							}else{
								echo "No data.";
							}
						}else{
							echo "No data.";
						}
					echo "</pre></p></div>";

					echo "<div id='debugContent-5'><p><pre>";
						if(isset($_SESSION)) {
							if(count($_SESSION) > 0){
								print_r($_SESSION);
							}else{
								echo "No data.";
							}
						}else{
							echo "No data.";
						}
					echo "</pre></p></div>";

					echo "<div id='debugContent-6'><p><pre>";
	echo "<b>Impact sur la mémoire:</b>";
	$unit = array('b','kb','mb','gb','tb','pb');
	echo @round(memory_get_usage(true)/pow(1024,($i=floor(log(memory_get_usage(true),1024)))),2).' '.$unit[$i].'<br>';

	echo "<b>Communication:</b> ";
	if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on'){
		echo 'Sécurisée par HTTPS (443).<br>';
	}else{
		echo 'Non sécurisée par HTTPS (443).<br>';
	}

	echo '<b>Version PHP:</b> ';
	echo phpversion().'<br>';
					echo '</pre>
							</p>
						</div>
					</div>
				</div>
			';**/
		echo '<script>function debugAll() { var x = document.getElementById("debugContainer"); if (x.style.display === "none") { x.style.display = "block"; } else { x.style.display = "none"; } } </script>';
		}

	}
?>
