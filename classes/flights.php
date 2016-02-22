<?php #class flights
class flights {

	//returns an array of flight objects
	public static function getAll() {
		$query = db::query("SELECT id FROM flight");
		$flightArray = array();
		foreach($query as $flightRow) {
			if ($flightRow['id']>0){
				$flightArray[] = new flight($flightRow['id']);
			}
		}
		return $flightArray;
	}
}