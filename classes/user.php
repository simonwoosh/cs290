<?php #user class

require_once 'includes/config.php';

class user {
	
	private $id;
	private $first_name;
	private $last_name;
	private $username;	
	private $password;

	
	/*
	 * returns a user object with information
	 * from the user with id=$ID in the database
	 */
	public function __construct($ID) {
		$query = db::prepare("SELECT * FROM user WHERE id=?");
		$query->bindValue(1,$ID);
		try {
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}
		$userInfo = $query->fetchAll();
		$this->id = $userInfo[0][0];
		$this->username = $userInfo[0][1];
		$this->password = $userInfo[0][2];
		$this->first_name = $userInfo[0][3];
		$this->last_name = $userInfo[0][4];
		$this->email = $userInfo[0][5];



	}

	public function getID() {
		return $this->id;
	}
	public function getUsername() {
		return $this->username;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getFirst_name() {
		return $this->first_name;
	}
	public function getLast_name() {
		return $this->last_name;
	}
	public function getEmail() {
		return $this->email;
	}

}

?>
