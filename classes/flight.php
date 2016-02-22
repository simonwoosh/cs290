<?php #flight class

class flight {
	
	private $id;
	private $start;
	private $end;
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
		$this->start = $flightInfo[0][1];
		$this->end = $flightInfo[0][2];
		$this->date_added = $flightInfo[0][3];
		$this->date_updated = $flightInfo[0][4];

	}

	public function getId() {
		return $this->id;
	}
		public function getStart() {
		return $this->start;
	}
	public function getEnd() {
		return $this->end;
	}
	public function getDate_added() {
		return $this->date_added;
	}
	public function getDate_updated() {
		return $this->date_updated;
	}
}

?>
