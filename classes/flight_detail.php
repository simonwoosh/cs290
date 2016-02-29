<?php #flight_detail class

class flight_detail {
	
	public $id;
	public $flight_id;
	public $model_id;
	public $capacity;
	public $flight_status;	
	public $delayed_time;
	public $estimated_duration;
	public $departure_time;
	public $unit_price;
	public $date_added;
	public $date_updated;

	
	/*
	 * returns a flight_detail object with information
	 * from the flight_detail with id=$ID in the database
	 */
	public function __construct($ID) {
		$query = db::prepare("SELECT * FROM flight_detail WHERE id=?");
		$query->bindValue(1,$ID);
		try {
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}
		$flight_detailInfo = $query->fetchAll();
		$this->id = $flight_detailInfo[0][0];
		$this->flight_id = $flight_detailInfo[0][1];
		$this->model_id = $flight_detailInfo[0][2];
		$this->capacity = $flight_detailInfo[0][3];
		$this->flight_status = $flight_detailInfo[0][4];
		$this->delayed_time = $flight_detailInfo[0][5];
		$this->estimated_duration = $flight_detailInfo[0][6];
		$this->departure_time = $flight_detailInfo[0][7];
		$this->unit_price = $flight_detailInfo[0][8];
		$this->date_added = $flight_detailInfo[0][9];
		$this->date_updated = $flight_detailInfo[0][10];

	}

	public function getId() {
		return $this->id;
	}
	public function getFlight_id() {
		return $this->flight_id;
	}
	public function getModel_id() {
		return $this->model_id;
	}
	public function getCapacity() {
		return $this->capacity;
	}
	public function getFlight_status() {
		return $this->flight_status;
	}
	public function getDelayed_time() {
		return $this->delayed_time;
	}
	public function getEstimated_duration() {
		return $this->estimated_duration;
	}
	public function getDeparture_time() { 
		return $this->departure_time;
	}
	public function getUnit_price() { 
		return $this->unit_price;
	}
	public function getDate_added() { 
		return $this->date_added;
	}
	public function getDate_updated() { 
		return $this->date_updated;
	}
}

?>
