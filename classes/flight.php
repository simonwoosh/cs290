<?php #flight class

class flight {
	
	private $id;
	private $start_location;
	private $end_location;
	private $date_added;	
	private $date_updated;


	
	/*
	 * returns a flight object with information
	 * from the flight with id=$ID in the database
	 */
	public function __construct($ID) {
		$query = db::prepare("SELECT * FROM flight WHERE id=?");
		$query->bindValue(1,$ID);
		try {
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}
		$flightInfo = $query->fetchAll();
		$this->id = $flightInfo[0][0];
		$this->start_location = $flightInfo[0][1];
		$this->end_location = $flightInfo[0][2];
		$this->date_added = $flightInfo[0][3];
		$this->date_updated = $flightInfo[0][4];

	}

	public function getId() {
		return $this->id;
	}
		public function getStart_location() {
		return $this->start_location;
	}
	public function getEnd_location() {
		return $this->end_location;
	}
	public function getDate_added() {
		return $this->date_added;
	}
	public function getDate_updated() {
		return $this->date_updated;
	}
}

?>
