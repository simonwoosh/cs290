<?php #airport class

class airport {
	
	private $id;
	private $airport_name;
	private $airport_location;
	private $airport_code;
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
		$this->airport_name = $airportInfo[0][1];
		$this->airport_location = $airportInfo[0][2];
		$this->airport_code = $airportInfo[0][3];
		$this->timezone = $airportInfo[0][4];
		$this->date_added = $airportInfo[0][5];
		$this->date_updated = $airportInfo[0][6];


	}

	public function getId() {
		return $this->id;
	}
	public function getAirport_name() {
		return $this->airport_name;
	}
	public function getAirport_location() {
		return $this->airport_location;
	}
	public function getAirport_code() {
		return $this->airport_code;
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
