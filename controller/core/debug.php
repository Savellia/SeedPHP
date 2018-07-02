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
			global $viewConcat;
			global $debug;
			global $folderControllerConcat;
			global $folderModelConcat;
			global $parseModel1;

			echo '
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
					#debugContainer input#tab-0:checked ~ #debugContent #debugContent-0,
					#debugContainer input#tab-1:checked ~ #debugContent #debugContent-1,
					#debugContainer input#tab-2:checked ~ #debugContent #debugContent-2,
					#debugContainer input#tab-3:checked ~ #debugContent #debugContent-3,
					#debugContainer input#tab-4:checked ~ #debugContent #debugContent-4,
					#debugContainer input#tab-5:checked ~ #debugContent #debugContent-5,
					#debugContainer input#tab-6:checked ~ #debugContent #debugContent-6 {
					  opacity: 1;
					  z-index: 100;
					}
				</style>';

			echo '
				<button id="debugButton" onclick="debugAll()">DebugAll</button>
				<div id="debugContainer">
					<input id="tab-0" type="radio" name="tab-group" checked="checked" />
					<label for="tab-0">VIEW</label>
					<input id="tab-1" type="radio" name="tab-group" />
					<label for="tab-1">GET</label>
					<input id="tab-2" type="radio" name="tab-group" />
					<label for="tab-2">POST</label>
					<input id="tab-3" type="radio" name="tab-group" />
					<label for="tab-3">FILES</label>
					<input id="tab-4" type="radio" name="tab-group" />
					<label for="tab-4">SQL</label>
					<input id="tab-5" type="radio" name="tab-group" />
					<label for="tab-5">SESSION</label>
					<input id="tab-6" type="radio" name="tab-group" />
					<label for="tab-6">+</label>
					<div id="debugContent">
					<div id="debugContent-0">
							<p>
								<pre>
<b>Vue:</b> '.$parseModel1[1].'
<b>Contrôleur:</b> '.$folderControllerConcat.'
<b>Modèle:</b> '.$folderModelConcat.'<br>
<b>Données retournées dans la vue:</b> ';
									if(count($viewConcat) > 0){
											$debug->that($viewConcat);
									}else{
										echo "No data.";
									}
					echo "</pre>";
					echo "</p>";
					echo "</div>";
					echo "<div id='debugContent-1'>";
					echo "<p>";
					echo "<pre>";
						if(count($_GET) > 0){
							print_r($_GET);
						}else{
							echo 'No data.';
						}
					echo "</pre>";
					echo "</p>";
					echo "</div>";
					echo "<div id='debugContent-2'>";
					echo "<p>";
					echo "<pre>";
						if(count($_POST) > 0){
							print_r($_POST);
						}else{
							echo "No data.";
						}
					echo "</pre>";
					echo "</p>";
					echo "</div>";
					echo "<div id='debugContent-3'>";
					echo "<p>";
					echo "<pre>";
						if(count($_FILES) > 0){
							print_r($_FILES);
						}else{
							echo "No data.";
						}
					echo "</pre>";
					echo "</p>";
					echo "</div>";
					echo "<div id='debugContent-4'>";
					echo "<p>";
					echo "<pre>";
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
					echo "</pre>";
					echo "</p>";
					echo "</div>";
					echo "<div id='debugContent-5'>";
					echo "<p>";
					echo "<pre>";
						if(isset($_SESSION)) {
							if(count($_SESSION) > 0){
								print_r($_SESSION);
							}else{
								echo "No data.";
							}
						}else{
							echo "No data.";
						}
					echo "</pre>";
					echo "</p>";
					echo "</div>";
					echo "<div id='debugContent-6'>";
					echo "<p>";
					echo "<pre>";
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
			';
		echo '<script>
					function debugAll() {
							var x = document.getElementById("debugContainer");
							if (x.style.display === "none") {
									x.style.display = "block";
							} else {
									x.style.display = "none";
							}
					}
				</script>';
		}

	}
	if($_ENV['debug']){
		$debug = new debug();
		$debug->all();
	}
?>
