<?php #passenger class

class passenger {
	
	private $id;
	private $prefix;
	private $first_name;
	private $last_name;	
	private $middle_name;
	private $suffix;
	private $date_of_birth;
	private $gender;
	private $emergency_contact_phone;
	private $emergency_contact_country;
	private $emergency_contact_first_name;
	private $emergency_contact_last_name;
	private $date_added;
	private $date_updated;


	
	/*
	 * returns a passenger object with information
	 * from the passenger with id=$ID in the database
	 */
	public function __construct($ID) {
		$query = db::prepare("SELECT * FROM passenger WHERE id=?");
		$query->bindValue(1,$ID);
		try {
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}
		$passengerInfo = $query->fetchAll();
		$this->id = $passengerInfo[0][0];
		$this->prefix = $passengerInfo[0][1];
		$this->first_name = $passengerInfo[0][2];
		$this->last_name = $passengerInfo[0][3];
		$this->middle_name = $passengerInfo[0][4];
		$this->suffix = $passengerInfo[0][5];
		$this->date_of_birth = $passengerInfo[0][6];
		$this->gender = $passengerInfo[0][7];
		$this->emergency_contact_phone = $passengerInfo[0][8];
		$this->emergency_contact_country = $passengerInfo[0][9];
		$this->emergency_contact_first_name = $passengerInfo[0][10];
		$this->emergency_contact_last_name = $passengerInfo[0][11];
		$this->date_added = $userInfo[0][12];
		$this->date_updated = $userInfo[0][13];


	}

	public function getId() {
		return $this->id;
	}
	public function getPrefix() {
		return $this->prefix;
	}
	public function getFirst_name() {
		return $this->first_name;
	}
	public function getLast_name() {
		return $this->last_name;
	}
	public function getMiddle_name() {
		return $this->middle_name;
	}
	public function getSuffix() {
		return $this->suffix;
	}
	public function getDate_of_birth() { 
		return $this->date_of_birth;
	}
	public function getGender() { 
		return $this->gender;
	}
	public function getEmergency_contact_phone() { 
		return $this->emergency_contact_phone;
	}
	public function getEmergency_contact_country() { 
		return $this->emergency_contact_country;
	}
	public function getEmergency_contact_first_name() { 
		return $this->emergency_contact_first_name;
	}
	public function getEmergency_contact_last_name() { 
		return $this->emergency_contact_last_name;
	}
	public function getDate_added() { 
		return $this->date_added;
	}
	public function getDate_updated() { 
		return $this->date_updated;
	}
}

?>
