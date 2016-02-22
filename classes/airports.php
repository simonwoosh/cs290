<?php #class airports
class airports {

	//returns an array of airport objects
	public static function getAll() {
		$query = db::query("SELECT id FROM airport");
		$airportArray = array();
		foreach($query as $airportRow) {
			if ($airportRow['id']>0){
				$airportArray[] = new airport($airportRow['id']);
			}
		}
		return $airportArray;
	}

	public static function create($name, $code, $timezone) {
		$query = db::prepare("INSERT INTO airport (name, code,timezone) VALUES(?,?,?)");
		$query->bindValue(1, $name);
		$query->bindValue(2, $code);
		$query->bindValue(3, $timezone);
	}
}