<?php
	require("Group.php");
	require("User.php");
	
	session_start(); 							// Inicia o reinicia la sesi�n
	$group = new Group;							// Crean un [Grupo]
	$user = new User;							// Crea un [Usuario]
	$user_id = $user->getLoggedInUser()->id; 	// Obtiene el identificador del usuario en sesi�n
	$names = $group->listGroups($user_id); 		// Devuelve una lista con los nombres de los grupos a los que pertenece $user_id
	echo '{"names":'. json_encode($names) .'}'; // Empaqueta la respuesta
	?>