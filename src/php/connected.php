<?php
	require("User.php");
	
	session_start(); 						 // Inicia o reinicia la sesi�n
	$user = new User;						 // Crea un [Usuario]
	$userSession = $user->getLoggedInUser(); // Devuelve el usuario en sesi�n
	if($userSession == false){				 // Si $userSession es igual a falso no hay un usuario en sesi�n 
		echo "Error: no login";				 // Informa del error
	}	
	?>