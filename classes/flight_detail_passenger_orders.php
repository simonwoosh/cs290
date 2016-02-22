<?php #class flight_detail_passenger_orders
class flight_detail_passenger_orders {

	//returns an array of flight_detail_passenger objects
	public static function getAll() {
		$query = db::query("SELECT id FROM flight_detail_passenger");
		$flight_detail_passengerArray = array();
		foreach($query as $flight_detail_passengerRow) {
			if ($flight_detail_passengerRow['id']>0){
				$flight_detail_passengerArray[] = new flight_detail_passenger($flight_detail_passengerRow['id']);
			}
		}
		return $flight_detail_passengerArray;
	}
}