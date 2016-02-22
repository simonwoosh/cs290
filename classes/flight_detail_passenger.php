<?php #flight_detail_passenger class

class flight_detail_passenger {
	
	private $id;
	private $fd_id;
	private $p_id;
	private $date_added;	
	private $date_updated;
	

	
	/*
	 * returns a flight_detail_passenger object with information
	 * from the flight_detail_passenger with id=$ID in the database
	 */
	public function __construct($ID) {
		$query = db::prepare("SELECT * FROM flight_detail_passenger WHERE id=?");
		$query->bindValue(1,$ID);
		try {
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}
		$flight_detail_passengerInfo = $query->fetchAll();
		$this->id = $flight_detail_passengerInfo[0][0];
		$this->fd_id = $flight_detail_passengerInfo[0][1];
		$this->p_id = $flight_detail_passengerInfo[0][2];
		$this->date_added = $flight_detail_passengerInfo[0][3];
		$this->date_updated = $flight_detail_passengerInfo[0][4];
	}

	public function getId() {
		return $this->id;
	}
	public function getfd_id() {
		return $this->fd_id;
	}
	public function getp_id() {
		return $this->p_id;
	}
	public function getDate_added() { 
		return $this->date_added;
	}
	public function getDate_updated() { 
		return $this->date_updated;
	}
}

?>
