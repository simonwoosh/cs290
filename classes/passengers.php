<?php #class passengers
class passengers {

	//returns an array of passenger objects
	public static function getAll() {
		$query = db::query("SELECT id FROM passenger");
		$passengerArray = array();
		foreach($query as $passengerRow) {
			if ($passengerRow['id']>0){
				$passengerArray[] = new passenger($passengerRow['id']);
			}
		}
		return $passengerArray;
	}
}