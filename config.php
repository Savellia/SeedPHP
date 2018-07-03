<?php
	namespace App\env;

	# Configure your SQL connection with PDO
	# Configurer votre connexion SQL avec PDO
	/*
	$_ENV["sqlConnector"] = array(
								"dbHost" => "localhost",
								"dbUser" => "root",
								"dbPass" => "",
								"dbName" => "project",
								"dbDriver" => "mysql"
							);
	*/
	
	# Enable sessions
	# Activer les sessions
	$_ENV["session"] = true;

	# Load the ORM (Object-Relational Mapping)
	# Charger le MOR (Mapping Objet-Relationnel)
	$_ENV["orm_access"] = true;

	# Select your default <folder/view>
	# Selectionner votre <dossier/vue>
	$_ENV["default_view"] = "default/index.php";

	# Load Debug interface
	# Charger l'interface de debug
	$_ENV["debug"] = true;
?>