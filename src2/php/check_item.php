﻿<?php
	require_once("Item.php");
	require_once("User.php");
	
	session_start();
	if ( isset($_SESSION['idList']) ) {
		$idList = $_SESSION['idList']; //obtenemos el id de la lista a partir de la variable POST
	}
	else {
		die ('No se ha seleccionado una lista');
	}
	if ( isset($_POST['idItem']) ) {
		$idItem = $_POST['idItem']; //obtenemos el id del item a partir de la variable POST
	}
	else {
		die ('No se ha seleccionado una lista');
	}
	//comprobamos que el usuario se ha autenticado y pertenece al grupo a cuya lista pertenece el item a marcar como comprado
	$currentUser = User::getLoggedInUser();
	if( !$currentUser ) {
		die ('Necesitas autenticarte para acceder a esta funcionalidad');
	}
	if( !Item::userBelongsToGroupOfItemList($currentUser->id, $idList, $idItem) ) {
		die ("No perteneces al grupo de la lista cuyos productos quieres listar");
	}
	Item::checkItem($idItem);
	//comprobamos si el item que se acaba de marcar como comprado 
	//fue el último que faltaba por comprar en la lista
	if( ShoppingList::isCompleted($idList) ) {
		//informamos de que se han marcado todos los items como comprados
		echo "closed";
	}
?>