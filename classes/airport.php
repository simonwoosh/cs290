<?php #airport class

class airport {
	
	private $id;
	private $name;
	private $code;
	private $timezone;
	private $date_added;	
	private $date_updated;


	
	/*
	 * returns a airport object with information
	 * from the airport with id=$ID in the database
	 */
	public function __construct($ID) {
		$query = db::prepare("SELECT * FROM airport WHERE id=?");
		$query->bindValue(1,$ID);
		try {
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}
		$airportInfo = $query->fetchAll();
		$this->id = $airportInfo[0][0];
		$this->name = $airportInfo[0][1];
		$this->code = $airportInfo[0][2];
		$this->timezone = $airportInfo[0][3];
		$this->date_added = $airportInfo[0][4];
		$this->date_updated = $airportInfo[0][5];


	}

	public function getId() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}
	public function getCode() {
		return $this->code;
	}
	public function getTimezone() {
		return $this->timezone;
	}
	public function getDate_added() {
		return $this->date_added;
	}
	public function getDate_updated() {
		return $this->date_updated;
	}
}

?>
