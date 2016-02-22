<?php #order class

class order {
	
	private $id;
	private $user_id;
	private $booking_code;
	private $total_cost;	
	private $payment_confirmed;
	private $date_added;
	private $date_updated;

	
	/*
	 * returns a order object with information
	 * from the order with id=$ID in the database
	 */
	public function __construct($ID) {
		$query = db::prepare("SELECT * FROM order WHERE id=?");
		$query->bindValue(1,$ID);
		try {
			$query->execute();
		}
		catch(PDOException $e) {
			die($e->getMessage());
		}
		$orderInfo = $query->fetchAll();
		$this->id = $orderInfo[0][0];
		$this->user_id = $orderInfo[0][1];
		$this->booking_code = $orderInfo[0][2];
		$this->total_cost = $orderInfo[0][3];
		$this->payment_confirmed = $orderInfo[0][4];
		$this->date_added = $orderInfo[0][5];
		$this->date_updated = $orderInfo[0][6];

	}

	public function getId() {
		return $this->id;
	}
	public function getUser_id() {
		return $this->user_id;
	}
	public function getBooking_code() {
		return $this->booking_code;
	}
	public function getTotal_cost() {
		return $this->total_cost;
	}
	public function getPayment_confirmed() {
		return $this->payment_confirmed;
	}
	public function getDate_added() { 
		return $this->date_added;
	}
	public function getDate_updated() { 
		return $this->date_updated;
	}
}

?>
