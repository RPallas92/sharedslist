<?php

/**
 * Class to handle app users
 */

class User
{
  // Properties

  /**
  * @var int The user ID from the database
  */
  public $id = null;

   /**
  * @var string The user's name
  */
  public $userName = null;
  
  
  /**
  * @var string The user's email address
  */
  public $emailAddress = null;

  /**
  * @var string The user's plaintext password
  */
  public $plaintextPassword = null;

  /**
  * @var string The user's encrypted password
  */
  public $password = null;


  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
	if ( isset( $data['userName'] ) ) $this->userName = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$\/ a-zA-Z0-9()]/", "", $data['userName'] );
    if ( isset( $data['emailAddress'] ) ) $this->emailAddress = preg_replace ( "/[^\.\-\_\@a-zA-Z0-9]/", "", $data['emailAddress'] );
    if ( isset( $data['plaintextPassword'] ) ) $this->plaintextPassword = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['plaintextPassword'] );
    if ( isset( $data['password'] ) ) $this->password = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$\/ a-zA-Z0-9()]/", "", $data['password'] );
  }


  /**
  * Encrypts the plaintext password in the plaintextPassword property, and stores the result in encryptedPassword.
  */

  public function encryptPassword() {
    $this->password = crypt ( $this->plaintextPassword );
  }


  /**
  * Checks that the supplied plaintext password is correct for this user
  *
  * @param string The plaintext password
  */

  public function checkPassword( $p ) {
    return ( $this->password == crypt ( $p, $this->password ) );
  }


  /**
  * Generates a new random password for the user.
  */

  public function generatePassword() {
		// por hacer
  }


  /**
  * Sends the user's plaintext password to their email address.
  */

  public function sendPassword() {
     // por hacer
	 //no se si debemos enviar la contrase�a en texto plano...
  }


  /**
  * Get the logged-in user (if any).
  *
  * @return User|false The logged-in user, or false if no login session could be found
  */

  static function getLoggedInUser() {
    if ( !isset( $_SESSION['userId']) ) return false;
    return User::getById( (int)$_SESSION['userId'] );
  }
  

  /**
  * Creates a valid login session for this user, logging them in.
  */

  function createLoginSession() {
    session_regenerate_id( true );
    $_SESSION['userId'] = $this->id;
    srand();
    $_SESSION['authToken'] = rand( 10e16, 10e20 );
  }


  /**
  * Destroy a login session, logging the user out.
  */

  function destroyLoginSession() {
    unset( $_SESSION['userId'] );
    session_destroy();

    if ( isset( $_COOKIE[session_name()] ) ) {
      setcookie( session_name(), "", time()-3600, "/" );
    }
  }


  /**
  * Returns a User object matching the given ID.
  *
  * @param int The user ID
  * @return User|null The User object, or null if the record was not found or there was a problem
  */

  public static function getById( $id ) {
    //por hacer
    if ( $row ) return new User( $row );
  }

  /**
  * Returns a User object matching the given email address.
  *
  * @param int The email address
  * @return User|null The User object, or null if the record was not found or there was a problem
  */

  public static function getByEmailAddress( $email) {
	
	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	} 
	$sql = "SELECT * FROM users WHERE emailAddress = '".$email."'";
	
	
	
	
	
	$result = mysqli_query($con, $sql);


	$row = mysqli_fetch_array($result);

	mysqli_close($con);
	
	if ( $row ) return new User( $row );
  }



  /**
  * Inserts the current User object into the database, and sets its ID property.
  */

  public function insert() {

	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);
	if (!$con) {
		die('Could not connect: ' . mysqli_error($con));
	}

    // Insert the User
	$sql = "INSERT INTO users (userName, emailAddress, password) values ('".$this->userName."', '".$this->emailAddress."', '".$this->password."')";
    mysqli_query($con, $sql);
	
    $this->id = mysqli_insert_id($con); //asocia al objeto User la id que se ha a�adido en la bd

	mysqli_close($con);
  }


  /**
  * Updates the current User object in the database.
  */

  public function update() {

    // por hacer
   
  }


  /**
  * Deletes the current User object from the database.
  */

  public function delete() {

	// por hacer
  }

}

?>