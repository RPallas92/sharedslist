<?php
	require_once("ShoppingList.php");
	require_once("User.php");
	
	session_start();
	//$idGroup = $_SESSION['idGroup'] //obtenemos el id del grupo a partir de la sesi�n
	$idGroup = 1 ; //lo pongo a 1 mientras no pueda obtener el idGroup de la sesi�n
	//obtenemos las listas de compra del grupo actualmente seleccionado
	$lists = ShoppingList::listSLists($idGroup);
	echo json_encode($lists); 
	?>