<?php

require("config.php");

class Group
{
	// Identificador n�merico de grupo
	public $id = null;
  
	// Nombre de grupo
	public $group_name = null;
  
	// Identificador n�merico del [Usuario] administrador 
	public $admin = null;

  
	/*
	 * Inserta la clase [Grupo] en la base de datos
	 */
	public function insert() {

		$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);
		
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
	
		$sql = "INSERT INTO `group` (groupName, idAdmin) values ('".$this->group_name."', '".$this->admin."')";
		mysqli_query($con, $sql);
		$this->id = mysqli_insert_id($con);
		mysqli_close($con);
	}

  
	/*
	 * Inserta al [Usuario] cuyo email coincide con el parametro de entrada $email
	 * como un nuevo miembro de la clase [Grupo] en la base de datos
	 */
	public function insertUser($email) {
  
		$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);
    
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
		
		$sql = "SELECT (idUser) FROM `user` WHERE emailAddress = '".$email."'";
		$rows = mysqli_query($con, $sql);
		while ($row=mysqli_fetch_row($rows))
		{		
			$sql = "INSERT INTO groupanduser (idGroup, idUser) values ('".$this->id."', '".$row[0]."')";
			mysqli_query($con, $sql);
		}
		mysqli_close($con);
	}
  
	/*
	 * Devuelve una lista con los nombres de [Grupo] a los que
	 * pertenece el parametro de entrada $user, el cual es un 
	 * identificador de [Usuario]
	 */
	public function listGroups($user) {
  
		$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);
    
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
		
		$sql = "SELECT (idGroup) FROM groupanduser WHERE idUser = '".$user."'";
		$rows = mysqli_query($con, $sql);
		$groups = array();
		while ($row=mysqli_fetch_row($rows))
		{
			$sql = "SELECT (groupName) FROM `group` WHERE idGroup = ".$row[0]."";
			$names = mysqli_query($con, $sql);
			while ($name=mysqli_fetch_row($names))
			{
				array_push($groups, $name[0]);
			}
		}
		mysqli_close($con);
		return $groups;
	}
	
}

?>
