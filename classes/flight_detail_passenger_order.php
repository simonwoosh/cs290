<?php #flight_detail_passenger_order class

class flight_detail_passenger_order {
	
	private $id;
	private $fdp_id;
	private $o_id;
	private $date_added;	
	private $date_updated;
	

	
	/*
	 * returns a flight_detail_passenger_order object with information
	 * from the flight_detail_passenger_order with id=$ID in the database
	 */
	public function __construct($ID) {
		$query = db::prepare("SELECT * FROM flight_detail_passenger_order WHERE id=?");
		$query->bindValue(1,$ID);
		try {
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}
		$flight_detail_passenger_orderInfo = $query->fetchAll();
		$this->id = $flight_detail_passenger_orderInfo[0][0];
		$this->fdp_id = $flight_detail_passenger_orderInfo[0][1];
		$this->o_id = $flight_detail_passenger_orderInfo[0][2];
		$this->date_added = $flight_detail_passenger_orderInfo[0][3];
		$this->date_updated = $flight_detail_passenger_orderInfo[0][4];
	}

	public function getId() {
		return $this->id;
	}
	public function getFdp_id() {
		return $this->fdp_id;
	}
	public function getO_id() {
		return $this->o_id;
	}
	public function getDate_added() { 
		return $this->date_added;
	}
	public function getDate_updated() { 
		return $this->date_updated;
	}
}

?>
