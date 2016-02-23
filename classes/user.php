<?php #user class

class user {
	
	private $id;
	private $first_name;
	private $last_name;
	private $username;	
	private $password;
	private $email;
	private $confirmed;
	private $confirm_code;
	private $date_added;
	private $date_updated;

	
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
		$this->first_name = $userInfo[0][1];
		$this->last_name = $userInfo[0][2];
		$this->username = $userInfo[0][3];
		$this->password = $userInfo[0][4];
		$this->email = $userInfo[0][5];
		$this->confirmed = $userInfo[0][6];
		$this->confirm_code = $userInfo[0][7];
		$this->date_added = $userInfo[0][8];
		$this->date_updated = $userInfo[0][9];

	}

	public function getId() {
		return $this->id;
	}
	public function getFirst_name() {
		return $this->first_name;
	}
	public function getLast_name() {
		return $this->last_name;
	}
	public function getUsername() {
		return $this->username;
	}
	public function getPassword() {
		return $this->password;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getConfirmed() { 
		return $this->confirmed;
	}
	public function getConfirm_code() { 
		return $this->confirmed_code;
	}
	public function getDate_added() { 
		return $this->date_added;
	}
	public function getDate_updated() { 
		return $this->date_updated;
	}
}

?>
