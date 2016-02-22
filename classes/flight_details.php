<?php #class flight_details
class flight_details {

	//returns an array of flight_detail objects
	public static function getAll() {
		$query = db::query("SELECT id FROM flight_detail");
		$flight_detailArray = array();
		foreach($query as $flight_detailRow) {
			if ($flight_detailRow['id']>0){
				$flight_detailArray[] = new flight_detail($flight_detailRow['id']);
			}
		}
		return $flight_detailArray;
	}
}